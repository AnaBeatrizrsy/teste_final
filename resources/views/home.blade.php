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
        .perfil {
            text-align: center;
            border: 1px solid #C2BEBE;
            background-color: #fff;
            padding: 10px;
        }
        .perfil img { width: 120px; height: 120px; border-radius: 50%; }
        .perfil h3 { color: #000; margin: 10px 0 5px 0; }
        .perfil hr { border: 2px solid #D97014; margin: 10px 0; }
        .main { border: 2px solid #C2BEBE; background: #fff; padding: 10px; }
        .main h2 { text-align: center; color: #000; }
        .publicacao { border-bottom: 1px solid #ccc; margin-bottom: 15px; padding-bottom: 15px; }
        .publicacao img { width: 100%; border-radius: 5px; }
        .interacoes { display: flex; align-items: center; gap: 10px; margin-top: 5px; }
        .interacoes img { width: 20px; height: 20px; cursor: pointer; transition: .3s; }
        .interacoes img.ativo { filter: invert(33%) sepia(89%) saturate(3386%) hue-rotate(354deg) brightness(99%) contrast(109%); }
        .login { display: flex; justify-content: center; align-items: start; padding-top: 40px; }
        .login button { background: #D97014; color: #fff; border: none; padding: 10px 25px; border-radius: 6px; font-weight: bold; cursor: pointer; }
        footer { grid-column: 1/4; background: #D97014; color: #fff; text-align: center; padding: 10px 0; }
        footer img { width: 20px; margin: 0 5px; vertical-align: middle; }
        #modalLogin {
            display: none; position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center; align-items: center;
        }
        .modal-conteudo {
            background: #fff; padding: 25px; border-radius: 10px;
            width: 300px; text-align: center;
        }
        .modal-conteudo input {
            width: 90%; padding: 8px; margin-bottom: 10px;
            border: 1px solid #ccc; border-radius: 4px;
        }
        .erro { border: 2px solid red !important; }
    </style>
</head>
<body>

    {{-- PERFIL --}}
    <div class="perfil">
        @auth
            <img src="{{ asset('anexos/' . Auth::user()->foto) }}" alt="Foto do usuário">
            <h3>{{ Auth::user()->nome }}</h3>
            <hr>
            <p>Total de Likes</p>
            <strong>{{ $usuarioLikes }}</strong>
            <p>Total de Dislikes</p>
            <strong>{{ $usuarioDislikes }}</strong>
        @else
            <img src="{{ asset('anexos/' . $empresa->logo) }}" alt="Logo da empresa">
            <h3>{{ $empresa->nome }}</h3>
            <hr>
            <p>Total de Likes</p>
            <strong>{{ $empresa_likes }}</strong>
            <p>Total de Dislikes</p>
            <strong>{{ $empresa_dislikes }}</strong>
        @endauth
    </div>

    {{-- PUBLICAÇÕES --}}
    <div class="main">
        <h2>Publicações</h2>
        @foreach($publicacoes as $pub)
            <div class="publicacao">
                <h3>{{ $pub->titulo_prato }}</h3>
                <img src="{{ asset('anexos/' . $pub->foto) }}" alt="{{ $pub->titulo_prato }}">
                <p>{{ $pub->local }} - {{ $pub->cidade }}</p>
                <div class="interacoes">
                    <img src="{{ asset('anexos/flecha_cima_vazia.svg') }}" 
                         class="btn-like {{ $pub->liked ? 'ativo' : '' }}" 
                         data-id="{{ $pub->id_publicacao }}">
                    <span id="likes-{{ $pub->id_publicacao }}">{{ $pub->likes }}</span>

                    <img src="{{ asset('anexos/flecha_baixo_vazia.svg') }}" 
                         class="btn-dislike {{ $pub->disliked ? 'ativo' : '' }}" 
                         data-id="{{ $pub->id_publicacao }}">
                    <span id="dislikes-{{ $pub->id_publicacao }}">{{ $pub->dislikes }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- LOGIN --}}
    <div class="login">
        @guest
            <button id="abrirModalLogin">Entrar</button>
        @else
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Sair</button>
            </form>
        @endguest
    </div>

    {{-- RODAPÉ --}}
    <footer>
        Sabor do Brasil
        <img src="{{ asset('anexos/Instagram.svg') }}">
        <img src="{{ asset('anexos/Twitter.svg') }}">
        <img src="{{ asset('anexos/Whatsapp.svg') }}">
        <img src="{{ asset('anexos/Globe.svg') }}">
        <span>Copyright - 2024</span>
    </footer>

    {{-- MODAL LOGIN --}}
    <div id="modalLogin">
        <div class="modal-conteudo">
            <h3>Login</h3>
            <input type="email" id="emailLogin" placeholder="E-mail">
            <input type="password" id="senhaLogin" placeholder="Senha">
            <p id="msgErro" style="color:red; display:none;">Usuário ou senha incorreto</p>
            <div style="display:flex; justify-content:space-around; margin-top:10px;">
                <button type="button" id="btnCancelar" 
                        style="border:2px solid #D97014; background:none; color:#D97014;">Cancelar</button>
                <button type="button" id="btnEntrar" 
                        style="background:#D97014; color:#fff; border:none;">Entrar</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const modal = document.getElementById("modalLogin");
        const abrir = document.getElementById("abrirModalLogin");
        const cancelar = document.getElementById("btnCancelar");
        const entrar = document.getElementById("btnEntrar");

        if (abrir) abrir.onclick = () => modal.style.display = "flex";
        cancelar.onclick = () => modal.style.display = "none";

        entrar.onclick = async () => {
            const email = document.getElementById("emailLogin").value;
            const senha = document.getElementById("senhaLogin").value;
            const msg = document.getElementById("msgErro");

            const res = await fetch("{{ route('login.modal') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ email, senha })
            });

            const data = await res.json();
            if (!data.success) msg.style.display = "block";
            else window.location.href = "/?login=true";
        };

        document.querySelectorAll('.btn-like, .btn-dislike').forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                const tipo = btn.classList.contains('btn-like') ? 'like' : 'dislike';
                const rota = tipo === 'like' ? "{{ route('like') }}" : "{{ route('dislike') }}";

                const res = await fetch(rota, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ publicacao_id: id })
                });

                if (res.status === 401) return modal.style.display = "flex";

                const data = await res.json();
                document.getElementById(`likes-${id}`).textContent = data.likes;
                document.getElementById(`dislikes-${id}`).textContent = data.dislikes;

                btn.classList.toggle("ativo");
            });
        });
    });
    </script>
</body>
</html>
