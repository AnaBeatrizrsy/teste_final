<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sabor do Brasil</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: grid;
            grid-template-columns: 1fr 2fr 1fr; /* perfil | main | login */
            grid-template-rows: auto 60px; /* conteúdo + rodapé */
            gap: 10px;
            margin: 0;
            background-color: #f5f5f5;
        }

        /* --- COLUNA 1: PERFIL --- */

    .perfil {
        text-align: center;
        border: 1px solid #C2BEBE;
    }

    .perfil img {
        width: 120px;
        height: auto;
        border-radius: 50%;
    }

    .perfil h3 {
        margin: 10px 0 5px 0;
        color: #000;
    }

    .perfil hr {
        border: 2px solid #D97014;
        margin: 10px 0;
    }

        /* --- COLUNA 2: PUBLICAÇAO --- */
        .main {
            border: 2px solid #C2BEBE;
            background-color: #fff;
            padding: 10px;
        }
        .main h2 {
            text-align: center;
            color: #000;
        }
        .publicacao {
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .publicacao img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .publicacao h3 {
            margin: 5px 0;
        }
           .interacoes {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }

        .interacoes img {
            width: 18px;
            height: 18px;
            vertical-align: middle;
        }

        /* --- COLUNA 3: LOGIN --- */
        .login {
            display: flex;
            align-items: start;
            justify-content: center;
            padding-top: 40px;
        }
        .login button {
            background-color: #D97014;
            color: #FFF;
            font-weight: bold;
            border: none;
            padding: 10px 25px;
            border-radius: 6px;
            cursor: pointer;
        }

        /* --- RODAPÉ --- */
        footer {
            grid-column: 1 / 4; 
            background-color: #D97014;
            color: #FFF;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }
        footer img {
            width: 20px;
            margin: 0 5px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    {{-- COLUNA 1: PERFIL --}}
    <div class="perfil">
        <img src="{{ asset('anexos/logo_sabor_do_brasil.png') }}" alt="Logo da empresa">
        <h3>{{ $empresa->nome }}</h3>
        <hr>
        <p>Quantidade Likes</p>
        <strong>{{ $empresa_likes }}</strong>
        <p>Quantidade Dislikes</p>
        <strong>{{ $empresa_deslikes }}</strong>
    </div>

    {{-- COLUNA 2: PUBLICAÇÕES --}}
     {{-- COLUNA 2 --}}
    <div class="main">
        <h2>Publicações</h2>

        @foreach ($publicacoes as $pub)
            <div class="publicacao">
                <img src="{{ asset('anexos/' . $pub->foto) }}" alt="{{ $pub->titulo_prato }}" width="100%">
                <h3>{{ $pub->titulo_prato }}</h3>
                <p>{{ $pub->local }} - {{ $pub->cidade }}</p>
                <div class="interacoes">
                    <img src="{{ asset('anexos/like.svg') }}" alt="Curtir">
                    <span>{{ $pub->likes }}</span>
                    

                    <img src="{{ asset('anexos/dislike.svg') }}" alt="Não curtir">
                    <span>{{ $pub->dislikes }}</span>

                    <img src="{{ asset('anexos/comentario.svg') }}" alt="Comentários">
                    <span>{{ $pub->comentarios }}</span>
            </div>
            </div>
        @endforeach
    </div>

    {{-- COLUNA 3: LOGIN --}}
    <div class="login">
    @guest
        <a href="{{ route('login') }}">
            <button>Entrar</button>
        </a>
       
    @else
        <p>Olá, {{ Auth::user()->name }}!</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Sair</button>
        </form>
    @endguest
</div>

    {{-- RODAPÉ --}}
    <footer>
        Sabor do Brasil
        <img src="{{ asset('anexos/Instagram.svg') }}" alt="Instagram">
        <img src="{{ asset('anexos/Twitter.svg') }}" alt="Twitter">
        <img src="{{ asset('anexos/Whatsapp.svg') }}" alt="WhatsApp">
        <img src="{{ asset('anexos/Globe.svg') }}" alt="Globe">
        <span>Copyright - 2024</span>
    </footer>
</body>
</html>
