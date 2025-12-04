<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public function run()
    {
        // Vider la table des messages avant d'insérer
        DB::table('messages')->truncate();

        $messages = [
            'Salut, comment ça va ?',
            'Bonjour, j’ai une question.',
            'Es-tu disponible pour discuter ?',
            'Voici le fichier que tu demandais.',
            'Merci pour ton aide !',
            'Peux-tu vérifier ce document ?',
            'J’ai une bonne nouvelle à partager !',
            'On se voit demain ?',
            'J’envoie une image en pièce jointe.',
            'Regarde cette vidéo, c’est incroyable !'
        ];

        for ($i = 1; $i <= 200; $i++) {
            $sender_id = User::get()->random()->id;
            $receiver_id = User::get()->random()->id;

            // Éviter l'auto-envoi d'un message à soi-même
            while ($receiver_id == $sender_id) {
                $receiver_id = User::get()->random()->id;
            }

            $j = 200 - $i + 1;

            Message::create([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
                'message' => $messages[array_rand($messages)],
                'attachment_type' => 'text', // Peut être 'image', 'video', 'file'
                'created_at' => now()->subDays($j)
            ]);
        }
    }
}
