<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer\Customer;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'type' => ['required', 'in:particulier,societe'],
            'matricule_fiscal' => ['required', 'string', 'max:50', 'unique:customers'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'mobile' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        // Règles conditionnelles selon le type de client
        if ($data['type'] == 'particulier') {
            $rules['civility'] = ['nullable', 'in:M,Mme,Mlle'];
            $rules['full_name'] = ['required', 'string', 'max:255'];
            $rules['cin'] = ['nullable', 'string', 'max:50'];
            $rules['birth_date'] = ['nullable', 'date'];
        } else {
            $rules['company_name'] = ['required', 'string', 'max:255'];
            $rules['rc'] = ['nullable', 'string', 'max:50'];
            $rules['sector'] = ['nullable', 'string', 'max:100'];
            $rules['contact_person'] = ['nullable', 'string', 'max:255'];
            $rules['contact_phone'] = ['nullable', 'string', 'max:20'];
            $rules['contact_email'] = ['nullable', 'email', 'max:255'];
        }

        // Postal code est optionnel pour tous
        $rules['postal_code'] = ['nullable', 'string', 'max:20'];

        return Validator::make($data, $rules, [
            'full_name.required_if' => 'Le nom complet est requis pour les particuliers.',
            'company_name.required_if' => 'Le nom de l\'entreprise est requis pour les sociétés.',
            'matricule_fiscal.unique' => 'Ce matricule fiscal est déjà enregistré.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Préparation des données pour le client
        $customerData = [
            'type' => $data['type'],
            'matricule_fiscal' => $data['matricule_fiscal'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'city' => $data['city'],
            'postal_code' => $data['postal_code'] ?? null,
            'country' => $data['country'] ?? 'Tunisie',
        ];

        // Données spécifiques selon le type de client
        if ($data['type'] == 'particulier') {
            $customerData['civility'] = $data['civility'] ?? null;
            $customerData['full_name'] = $data['full_name'];
            $customerData['cin'] = $data['cin'] ?? null;
            $customerData['birth_date'] = $data['birth_date'] ?? null;
        } else {
            $customerData['company_name'] = $data['company_name'];
            $customerData['rc'] = $data['rc'] ?? null;
            $customerData['sector'] = $data['sector'] ?? null;
            $customerData['contact_person'] = $data['contact_person'] ?? null;
            $customerData['contact_phone'] = $data['contact_phone'] ?? null;
            $customerData['contact_email'] = $data['contact_email'] ?? null;
        }

        // Création du client
        $customer = Customer::create($customerData);

        // Création de l'utilisateur associé
        $user = User::create([
            'name' => $data['type'] == 'particulier' ? $data['full_name'] : $data['company_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'customer',
            'customer_id' => $customer->id
        ]);

        return $user;
    }

    protected function registered(Request $request, $user){
        return redirect($this->redirectPath())
            ->with('success', 'Votre compte a été créé avec succès. Vous êtes maintenant connecté.');
    }
}
