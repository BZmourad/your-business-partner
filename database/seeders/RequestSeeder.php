<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request\Request as ServiceRequest;
use App\Models\Document\Document;
use App\Models\Service\Service;
use App\Models\Customer\Customer;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RequestSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('fr_CA');
        
        // Créer un dossier temporaire pour les fichiers de test
        $tempDir = storage_path('app/temp_seeder');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        for ($i = 0; $i < 100; $i++) { 
            $service = Service::get()->random();
            $status = $faker->randomElement(['pending', 'in_progress', 'completed', 'refused']);
            
            $serviceRequest = ServiceRequest::create([
                'customer_id' => Customer::get()->random()->id,
                'service_id' => $service->id,
                'status' => $status,
                'created_at' => $faker->dateTimeBetween('-30 days', '-25 days')
            ]);
            $serviceRequest->update(['reference'=>getRefrence($serviceRequest->id, "RQ")]);

            $serviceRequest->histo()->create([
                'status' => 'pending',
                'created_at' => $serviceRequest->created_at
            ]);
            if (rand(0,1) && $status != "refused") {
                $serviceRequest->update(['paid_status' => 'paid']);
                $serviceRequest->histo()->create([
                    'status' => 'paid',
                    'created_at' => $faker->dateTimeBetween('-24 days', '-20 days')
                ]);
            }

            $this->seedHistoRequest($serviceRequest, $status, $faker);
            
            foreach ($service->fields as $field) {
                $serviceRequest->fields()->create([
                    'response' => $this->seedFieldResponse($field->type, $field->options, $faker),
                    'name' => $field->name,
                    'description' => $field->description,
                    'type' => $field->type,
                    'options' => $field->options,
                    'is_required' => $field->is_required,
                ]);
            }

            foreach ($service->documents as $document) {
                $requestDocument = Document::create([
                    'request_id' => $serviceRequest->id,
                    'name' => $document->name,
                    'description' => $document->description,
                    'is_required' => $document->is_required
                ]);
                $requestDocument->update(['reference'=>getRefrence($requestDocument->id, "DC")]);
                $this->seedDocumentFile($requestDocument, $faker, 'documents/'.$serviceRequest->reference);
            }
        }

        // Nettoyer le dossier temporaire
        $this->cleanupTempFiles($tempDir);
    }

    private function seedHistoRequest(ServiceRequest $serviceRequest, $status, $faker){
        if ($status == "in_progress") {
            if ($serviceRequest->paid_status != 'paid') {
                $serviceRequest->update(['paid_status' => 'paid']);
                $serviceRequest->histo()->create([
                    'status' => 'paid',
                    'created_at' => $faker->dateTimeBetween('-21 days', '-19 days')
                ]);
            }
            $serviceRequest->histo()->create([
                'status' => 'in_progress',
                'created_at' => $faker->dateTimeBetween('-18 days', '-15 days')
            ]);
        } elseif ($status == "completed") {
            if ($serviceRequest->paid_status != 'paid') {
                $serviceRequest->update(['paid_status' => 'paid']);
                $serviceRequest->histo()->create([
                    'status' => 'paid',
                    'created_at' => $faker->dateTimeBetween('-19 days', '-15 days')
                ]);
            }
            $serviceRequest->histo()->create([
                'status' => 'in_progress',
                'created_at' => $faker->dateTimeBetween('-14 days', '-6 days')
            ]);
            $serviceRequest->histo()->create([
                'status' => 'completed',
                'created_at' => $faker->dateTimeBetween('-5 days', 'now')
            ]);
        } elseif ($status == "refused") {
            $serviceRequest->histo()->create([
                'status' => 'refused',
                'created_at' => $faker->dateTimeBetween('-24 days', 'now')
            ]);
        }
    }

    private function seedFieldResponse($type, $options, $faker){
        $v = "";
        if ($options && in_array($type, ['single_select', 'multiple_select'])) {
            $o = is_array($options) ? $options : json_decode($options, true);
            if (is_array($o) && count($o) > 0) {
                $v = $faker->randomElement($o);
                if ($type === 'multiple_select') {
                    $v = json_encode([$v, $faker->randomElement($o)]);
                }
            }
        }

        switch ($type) {
            case 'short_text': return $faker->sentence(); break;
            case 'long_text': return $faker->paragraph(); break;
            case 'number': return rand(10,1000); break;
            case 'date': return $faker->date(); break;
            case 'datetime': return $faker->dateTime(); break;
            case 'single_select': return $v; break;
            case 'multiple_select': return $v; break;
            default: return $faker->sentence(); break;
        }
    }

    private function seedDocumentFile(Document $requestDocument, $faker, $folder){
        $tempDir = storage_path('app/temp_seeder');
        
        // Déterminer le type de fichier selon le type de document
        $fileTypes = [
            'pdf' => ['pdf', 'sample.pdf'],
            'image' => ['jpg', 'sample.jpg'],
            'document' => ['docx', 'sample.docx'],
        ];

        // Par défaut, utiliser PDF
        $fileExtension = 'pdf';
        $fileName = 'sample.pdf';
        $mimeType = 'application/pdf';
        $content = '%PDF-1.4 sample content';

        $fileExtension = 'pdf';
        $fileName = "sample.{$fileExtension}";
        $mimeType = 'application/pdf';
        // Créer un fichier texte simple pour la démo
        file_put_contents($tempDir . '/' . $fileName, "Sample {$fileExtension} document content");

        $filePath = $tempDir . '/' . $fileName;

        if (file_exists($filePath)) {
            // Créer un UploadedFile pour Media Library
            $uploadedFile = new UploadedFile(
                $filePath,
                $fileName,
                $mimeType,
                null,
                true // test mode
            );

            // Ajouter le fichier via Media Library
            $requestDocument->addDocument($uploadedFile, "1");

            // Optionnel: Personnaliser le nom du média
            $media = $requestDocument->getFirstMedia('documents');
            if ($media) {
                $media->update([
                    'name' => "Document {$requestDocument->id} - " . $faker->words(2, true),
                ]);
            }
        }
    }

    private function cleanupTempFiles($tempDir){
        if (file_exists($tempDir)) {
            $files = glob($tempDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($tempDir);
        }
    }
}