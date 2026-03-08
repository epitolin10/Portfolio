<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Admin Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; background: var(--bg); }
        .login-box {
            width: 100%; max-width: 400px; padding: 2rem;
            background: var(--bg2); border: 1px solid var(--border);
            border-radius: 16px;
        }
        .login-logo { text-align: center; margin-bottom: 2rem; }
        .login-logo span { font-family: var(--font-head); font-size: 1.5rem; font-weight: 800; }
        .login-title { font-family: var(--font-head); font-size: 1.2rem; font-weight: 700; margin-bottom: 1.5rem; text-align: center; }
    </style>
</head>
<body class="admin-body">

<div class="login-box">
    <div class="login-logo">
        <span><span class="logo-bracket">[</span>Admin<span class="logo-bracket">]</span></span>
    </div>
    <p class="login-title">Connexion au dashboard</p>

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}"
                   class="form-input @error('email') error @enderror"
                   autofocus required>
            @error('email')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group" style="margin-bottom:1.5rem">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password"
                   class="form-input @error('password') error @enderror"
                   required>
            @error('password')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="btn btn-primary btn-full">Se connecter</button>
    </form>

    <div style="text-align:center; margin-top:1rem;">
        <a href="{{ route('portfolio.index') }}" style="font-size:.85rem; color:var(--text-muted);">← Retour au portfolio</a>
    </div>
</div>

</body>
</html>