<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Connexion Administrateur</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #0f0f23;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    color: #e2e8f0;
    position: relative;
    overflow: hidden;
}

body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
    pointer-events: none;
}

.login-container {
    background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
    border: 1px solid #4a5568;
    border-radius: 1.5rem;
    padding: 3rem;
    width: 100%;
    max-width: 420px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(10px);
    animation: fadeInUp 0.8s ease-out;
}

.login-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.login-header {
    text-align: center;
    margin-bottom: 2rem;
}

.login-header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #f7fafc;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.login-header p {
    color: #a0aec0;
    font-size: 1rem;
    font-weight: 400;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    position: relative;
}

.form-group label {
    display: block;
    color: #cbd5e0;
    font-weight: 500;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.form-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    background: #2d3748;
    border: 2px solid #4a5568;
    border-radius: 0.75rem;
    color: #f7fafc;
    font-size: 1rem;
    transition: all 0.3s ease;
    position: relative;
}

.form-input:focus {
    outline: none;
    border-color: #667eea;
    background: #1a202c;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-input::placeholder {
    color: #718096;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    width: 1.25rem;
    height: 1.25rem;
    color: #718096;
    transition: color 0.3s ease;
}

.form-group:focus-within .input-icon {
    color: #667eea;
}

.btn-login {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 0.75rem;
    color: white;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    margin-top: 0.5rem;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
}

.btn-login:active {
    transform: translateY(0);
}

.btn-login::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.btn-login:hover::before {
    left: 100%;
}

.error-message {
    background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
    color: #742a2a;
    padding: 1rem;
    border-radius: 0.75rem;
    margin-bottom: 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    border: 1px solid #fc8181;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    animation: slideInDown 0.5s ease-out;
}

.error-icon {
    width: 1.25rem;
    height: 1.25rem;
    flex-shrink: 0;
}

.login-footer {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #4a5568;
}

.login-footer p {
    color: #718096;
    font-size: 0.875rem;
}

.login-footer a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
}

.login-footer a:hover {
    text-decoration: underline;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 480px) {
    .login-container {
        padding: 2rem;
    }
    
    .login-header h1 {
        font-size: 1.75rem;
    }
    
    body {
        padding: 1rem;
    }
}

.btn-login.loading {
    pointer-events: none;
    opacity: 0.7;
}

.btn-login.loading::after {
    content: '';
    position: absolute;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
}

@keyframes spin {
    0% { transform: translateY(-50%) rotate(0deg); }
    100% { transform: translateY(-50%) rotate(360deg); }
}
</style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Dashboard Admin</h1>
            <p>Connectez-vous pour accéder à votre espace</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <svg class="error-icon" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                </svg>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form class="login-form" action="index.php?action=doLogin" method="post">
            <div class="form-group">
                <label for="email">Adresse email</label>
                <div style="position: relative;">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12.75c1.63 0 3.07.39 4.24.9c1.08.48 1.76 1.56 1.76 2.73V18H6v-1.61c0-1.18.68-2.26 1.76-2.73c1.17-.52 2.61-.91 4.24-.91zM4 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2zm1.13 1.1c-.37-.06-.74-.1-1.13-.1c-.99 0-1.93.21-2.78.58A2.01 2.01 0 0 0 0 16.43V18h4.5v-1.61c0-.83.23-1.61.63-2.29zM20 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2zm4 3.43c0-.81-.48-1.53-1.22-1.85A6.95 6.95 0 0 0 20 14c-.39 0-.76.04-1.13.1c.4.68.63 1.46.63 2.29V18H24v-1.57zM12 6c1.66 0 3 1.34 3 3s-1.34 3-3 3s-3-1.34-3-3s1.34-3 3-3z"/>
                    </svg>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="admin@exemple.com"
                        required
                        autocomplete="email"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div style="position: relative;">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                    </svg>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                </div>
            </div>

            <button type="submit" class="btn-login">
                Se connecter
            </button>
        </form>

        <div class="login-footer">
            <p>© 2025 Dashboard Admin - Tous droits réservés</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('.login-form');
            const loginButton = document.querySelector('.btn-login');
            
            loginForm.addEventListener('submit', function() {
                loginButton.classList.add('loading');
                loginButton.textContent = 'Connexion...';
            });

            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            const title = document.querySelector('.login-header h1');
            const originalText = title.textContent;
            title.textContent = '';
            
            let i = 0;
            const typeWriter = () => {
                if (i < originalText.length) {
                    title.textContent += originalText.charAt(i);
                    i++;
                    setTimeout(typeWriter, 100);
                }
            };
            
            setTimeout(typeWriter, 500);
        });
    </script>
</body>
</html>