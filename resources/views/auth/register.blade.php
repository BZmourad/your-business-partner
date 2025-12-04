<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --text-color: #2b2d42;
            --light-color: #f8f9fa;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .form-section {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        .section-title {
            color: #3b7ddd;
            margin-bottom: 1.2rem;
            font-weight: 600;
        }
        .btn-register {
            color: white;
            width: 100%;
            padding: 0.75rem;
            font-weight: 600;
            border-radius: var(--border-radius);
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            letter-spacing: 0.5px;
            transition: var(--transition);
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            transition: var(--transition);
            z-index: -1;
        }
        .btn-register:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }
        .btn-register:hover::before {
            left: 0;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
        }
        .password-input-group {
            position: relative;
        }
        .animation-delay-1 { animation-delay: 0.1s; }
        .animation-delay-2 { animation-delay: 0.2s; }
        .animation-delay-3 { animation-delay: 0.3s; }
        .animation-delay-4 { animation-delay: 0.4s; }
        .animation-delay-5 { animation-delay: 0.5s; }
        .animation-delay-6 { animation-delay: 0.6s; }
        .animation-delay-7 { animation-delay: 0.7s; }
        .animation-delay-8 { animation-delay: 0.8s; }
        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .required-field::after {
            content: '*';
            color: #dc3545;
            margin-left: 3px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Créer un compte client</h2>
            <p class="text-muted">Rejoignez notre plateforme en remplissant le formulaire ci-dessous</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Section Type de client -->
            <div class="form-section fade-in animation-delay-1">
                <h5 class="section-title"><i class="fas fa-user-tie me-2"></i>Type de compte</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-check card h-100 p-3">
                            <input class="form-check-input" type="radio" name="type" id="individual" value="particulier" {{ old('type', 'particulier') == 'particulier' ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="individual">
                                <i class="fas fa-user me-2"></i>Particulier
                            </label>
                            <p class="text-muted small mt-2">Compte pour un client individuel</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check card h-100 p-3">
                            <input class="form-check-input" type="radio" name="type" id="company" value="societe" {{ old('type') == 'societe' ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="company">
                                <i class="fas fa-building me-2"></i>Entreprise
                            </label>
                            <p class="text-muted small mt-2">Compte pour une société ou organisation</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Champs pour particuliers -->
            <div id="individual-fields" class="fade-in">
                <div class="form-section">
                    <h5 class="section-title"><i class="fas fa-user-circle me-2"></i>Informations personnelles</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="civility" class="form-label">Civilité</label>
                            <select name="civility" id="civility" class="form-select">
                                <option value="M" {{ old('civility') == 'M' ? 'selected' : '' }}>M.</option>
                                <option value="Mme" {{ old('civility') == 'Mme' ? 'selected' : '' }}>Mme</option>
                                <option value="Mlle" {{ old('civility') == 'Mlle' ? 'selected' : '' }}>Mlle</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label required-field">Nom complet</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="birth_date" class="form-label">Date de naissance</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cin" class="form-label">CIN / Passeport</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" name="cin" id="cin" class="form-control" value="{{ old('cin') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Champs pour entreprises -->
            <div id="company-fields" style="display: none;" class="fade-in">
                <div class="form-section">
                    <h5 class="section-title"><i class="fas fa-building me-2"></i>Informations de l'entreprise</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label required-field">Nom de l'entreprise</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contact_person" class="form-label">Personne à contacter</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="contact_person" id="contact_person" class="form-control" value="{{ old('contact_person') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="rc" class="form-label">Registre de commerce</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-file-contract"></i></span>
                                <input type="text" name="rc" id="rc" class="form-control" value="{{ old('rc') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sector" class="form-label">Secteur d'activité</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-industry"></i></span>
                                <input type="text" name="sector" id="sector" class="form-control" value="{{ old('sector') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations fiscales -->
            <div class="form-section fade-in animation-delay-2">
                <h5 class="section-title"><i class="fas fa-file-invoice-dollar me-2"></i>Informations fiscales</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="matricule_fiscal" class="form-label required-field">Matricule fiscal</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card-alt"></i></span>
                            <input type="text" name="matricule_fiscal" id="matricule_fiscal" class="form-control" value="{{ old('matricule_fiscal') }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coordonnées -->
            <div class="form-section fade-in animation-delay-3">
                <h5 class="section-title"><i class="fas fa-address-book me-2"></i>Coordonnées</h5>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="address" class="form-label required-field">Adresse</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="postal_code" class="form-label">Code postal</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
                            <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label required-field">Ville</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-city"></i></span>
                            <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="country" class="form-label required-field">Pays</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', 'Tunisie') }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contacts -->
            <div class="form-section fade-in animation-delay-4">
                <h5 class="section-title"><i class="fas fa-phone-alt me-2"></i>Contacts</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label required-field">Téléphone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mobile" class="form-label required-field">Mobile</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label required-field">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3" id="company-contact-field" style="display: none;">
                        <label for="contact_phone" class="form-label">Téléphone du contact</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mot de passe -->
            <div class="form-section fade-in animation-delay-5">
                <h5 class="section-title"><i class="fas fa-lock me-2"></i>Sécurité</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label required-field">Mot de passe</label>
                        <div class="password-input-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <span class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label required-field">Confirmer le mot de passe</label>
                        <div class="password-input-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bouton d'inscription -->
            <div class="d-grid gap-2 mt-4 fade-in animation-delay-6">
                <button type="submit" class="btn btn-register btn-lg">
                    <i class="fas fa-user-plus me-2"></i> Créer mon compte
                </button>
            </div>

            <div class="text-center mt-4 fade-in animation-delay-7">
                <p>Vous avez déjà un compte ? <a href="{{ route('login') }}">Connectez-vous ici</a></p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion de l'affichage des champs en fonction du type de client
            const individualRadio = document.getElementById('individual');
            const companyRadio = document.getElementById('company');
            const individualFields = document.getElementById('individual-fields');
            const companyFields = document.getElementById('company-fields');
            const companyContactField = document.getElementById('company-contact-field');
            
            function toggleFields() {
                if (companyRadio.checked) {
                    individualFields.style.display = 'none';
                    companyFields.style.display = 'block';
                    companyContactField.style.display = 'block';
                    document.getElementById('company_name').setAttribute('required', 'required');
                    document.getElementById('full_name').removeAttribute('required');
                } else {
                    individualFields.style.display = 'block';
                    companyFields.style.display = 'none';
                    companyContactField.style.display = 'none';
                    document.getElementById('company_name').removeAttribute('required');
                    document.getElementById('full_name').setAttribute('required', 'required');
                }
            }
            
            individualRadio.addEventListener('change', toggleFields);
            companyRadio.addEventListener('change', toggleFields);
            
            // Initialisation
            toggleFields();
        });
        
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = passwordField.parentElement.nextElementSibling.querySelector('i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>