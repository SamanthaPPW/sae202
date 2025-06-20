<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
        }

        .form-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="40%"><stop offset="0%" style="stop-color:white;stop-opacity:0.1"/><stop offset="100%" style="stop-color:white;stop-opacity:0"/></radialGradient></defs><rect width="100" height="20" fill="url(%23a)"/></svg>');
            opacity: 0.3;
        }

        .form-title {
            font-size: 2em;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-title::before {
            content: '✏️';
            margin-right: 12px;
            font-size: 1.2em;
        }

        .form-subtitle {
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .form-content {
            padding: 40px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-weight: 500;
        }

        .alert-error {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #dc2626;
            border: 1px solid #f87171;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #059669;
            border: 1px solid #34d399;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95em;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4f46e5;
            background: white;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-group input:hover {
            border-color: #d1d5db;
            background: white;
        }

        .required {
            color: #ef4444;
        }

        .button-group {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 15px 25px;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1em;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
        }

        .btn::before {
            margin-right: 8px;
            font-size: 1.1em;
        }

        .btn-primary::before {
            content: '💾';
        }

        .btn-secondary::before {
            content: '↩️';
        }

        .info-note {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #1e40af;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #93c5fd;
            margin-bottom: 25px;
            font-size: 0.9em;
            line-height: 1.5;
        }

        .info-note::before {
            content: 'ℹ️';
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 10px;
            }
            
            .form-content {
                padding: 20px;
            }
            
            .button-group {
                flex-direction: column;
            }
            
            .form-title {
                font-size: 1.6em;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1 class="form-title">Modifier le profil</h1>
            <p class="form-subtitle">Mettez à jour vos informations personnelles</p>
        </div>
        
        <div class="form-content">
            <?php if (isset($_GET['success']) && $_GET['success'] == 'profile_updated'): ?>
                <div class="alert alert-success">
                    ✅ Votre profil a été mis à jour avec succès !
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    ❌ <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <div class="info-note">
                Les champs marqués d'un astérisque (<span class="required">*</span>) sont obligatoires. Votre mot de passe ne peut pas être modifié depuis cette page.
            </div>

            <form method="POST" action="/profil/modifier">
                <div class="form-group">
                    <label for="prenom">Prénom <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="prenom" 
                        name="prenom" 
                        value="<?php echo htmlspecialchars($user['prenom'] ?? ''); ?>" 
                        required
                        placeholder="Votre prénom"
                    >
                </div>

                <div class="form-group">
                    <label for="nom">Nom <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="nom" 
                        name="nom" 
                        value="<?php echo htmlspecialchars($user['nom'] ?? ''); ?>" 
                        required
                        placeholder="Votre nom de famille"
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" 
                        required
                        placeholder="votre.email@exemple.com"
                    >
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input 
                        type="tel" 
                        id="telephone" 
                        name="telephone" 
                        value="<?php echo htmlspecialchars($user['telephone'] ?? ''); ?>" 
                        placeholder="06 12 34 56 78"
                    >
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="/profil" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach((input, index) => {
                input.style.opacity = '0';
                input.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    input.style.transition = 'all 0.5s ease';
                    input.style.opacity = '1';
                    input.style.transform = 'translateY(0)';
                }, index * 100);
            });

            const emailInput = document.getElementById('email');
            emailInput.addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (this.value && !emailRegex.test(this.value)) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#4f46e5';
                }
            });

            const telInput = document.getElementById('telephone');
            telInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 0) {
                    value = value.match(/.{1,2}/g).join(' ');
                    if (value.length > 14) value = value.substring(0, 14);
                    this.value = value;
                }
            });
        });
    </script>
</body>
</html>