<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sabor do Brasil</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: grid;
            grid-template-columns: 1fr 2fr 1fr; 
            grid-template-rows: auto 60px; 
            gap: 10px;
            margin: 0;
            background-color: #f5f5f5;
        }

        /* --- COLUNA 1: PERFIL --- */
        .perfil {
            text-align: center;
            border: 1px solid #C2BEBE;
            background-color: #fff;
            padding: 10px;
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

        /* --- COLUNA 2: PUBLICAÇÕES --- */
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
            cursor: pointer;
        }

        /* --- COLUNA 3: LOGIN --- */
        .login {
            display: flex;
            align-items: start;
            justify-content: center;
            padding-top: 40px;
        }

        .login a {
            background-color: #D97014;
            color: #FFF;
            font-weight: bold;
            border: none;
            padding: 10px 25px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        /* --- MODAL LOGIN --- */
        #modalLogin {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.6);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .modal-conteudo {
            background: white;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            text-align: center;
        }

        input.erro {
            border: 2px solid red;
        }

        .btn-entrar {
            background-color: #D97014;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            padding: 5px 15px;
        }

        .btn-cancelar {
            border: 2px solid #D97014;
            color: #D97014;
            font-weight: bold;
            border-radius: 6px;
            padding: 5px 15px;
            text-decoration: none;
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
    <div class="main">
        <h2>Publicações</h2>

        @foreach ($publicacoes as $pub)
            <div class="publicacao">
                <img src="{{ asset('anexos/' . $pub->foto) }}" alt="{{ $pub->titulo_prato }}">
                <h3>{{ $pub->titulo_prato }}</h3>
                <p>{{ $pub->local }} - {{ $pub->cidade }}</p>
                <div class="interacoes">
                    {{-- Like/Dislike abrem modal se usuário não logado --}}
                    <a href="?login=true"><img src="{{ asset('anexos/flecha_cima_vazia.svg') }}" alt="Curtir"></a>
                    <span>{{ $pub->likes }}</span>

                    <a href="?login=true"><img src="{{ asset('anexos/flecha_baixo_vazia.svg') }}" alt="Não curtir"></a>
                    <span>{{ $pub->dislikes }}</span>

                    <img src="{{ asset('anexos/chat.svg') }}" alt="Comentários">
                    <span>{{ $pub->comentarios }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- COLUNA 3: LOGIN --}}
    <div class="login">
        @if(session('usuario_logado'))
            <div style="text-align:center;">
                <p><strong>Olá, {{ session('usuario_logado_nome') }}!</strong></p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-entrar">Sair</button>
                </form>
            </div>
        @else
            <a href="?login=true">Entrar</a>
        @endif
    </div>

    {{-- MODAL LOGIN --}}
    <div id="modalLogin">
        <div class="modal-conteudo">
            <h3>Login</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email"
                       placeholder="Digite seu e-mail"
                       value="{{ old('email') }}"
                       class="@error('email') erro @enderror"
                       required>

                <input type="password" name="senha"
                       placeholder="Digite sua senha"
                       class="@error('senha') erro @enderror"
                       required>

                @if($errors->any())
                    <p style="color:red; font-size:14px;">{{ $errors->first('msg') }}</p>
                @endif

                <div style="display:flex; justify-content:space-around; margin-top:10px;">
                    <a href="/" class="btn-cancelar">Cancelar</a>
                    <button type="submit" class="btn-entrar">Entrar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MOSTRAR MODAL SE ERRO OU ?login=true --}}
    @if($errors->any() || request('login') == 'true')
        <style>#modalLogin { display: flex; }</style>
    @endif

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
