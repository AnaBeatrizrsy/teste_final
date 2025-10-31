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
        .comentario-input { display: flex; gap:5px; margin-top:5px; }
        .comentario-input input { flex:1; padding:5px; }
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

                    @auth
                    <img src="{{ asset('anexos/chat.svg') }}" 
                        class="btn-chat" 
                        data-id="{{ $pub->id_publicacao }}" 
                        style="cursor:pointer; width:20px; height:20px;">
                    @endauth
                </div>

                <div class="comentarios" id="comentarios-{{ $pub->id_publicacao }}">
                    @foreach($pub->comentarios ?? [] as $c)
                        <div class="comentario">
                            <strong>{{ $c->nome }}:</strong> {{ $c->texto }}
                        </div>
                    @endforeach
                </div>



                @auth
                <div class="comentario-input" id="input-comentario-{{ $pub->id_publicacao }}" style="display:none;">
                    <input type="text" placeholder="Escreva um comentário..." class="input-comentario" data-id="{{ $pub->id_publicacao }}">
                    <button class="btn-comentar" data-id="{{ $pub->id_publicacao }}">Comentar</button>
                </div>
                @endauth
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

    {{-- SCRIPT --}}
    <script>
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modalLogin");
    const abrir = document.getElementById("abrirModalLogin");
    const cancelar = document.getElementById("btnCancelar");
    const entrar = document.getElementById("btnEntrar");

    // --- MODAL LOGIN ---
    if (abrir) abrir.onclick = () => modal.style.display = "flex";
    cancelar.onclick = () => modal.style.display = "none";

    entrar.onclick = async () => {
        const email = document.getElementById("emailLogin").value;
        const senha = document.getElementById("senhaLogin").value;
        const msg = document.getElementById("msgErro");

        try {
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
        } catch(err) {
            console.error("Erro no login:", err);
        }
    };

    // --- LIKES / DISLIKES ---
    document.querySelectorAll('.btn-like, .btn-dislike').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            const tipo = btn.classList.contains('btn-like') ? 'like' : 'dislike';
            const rota = tipo === 'like' ? "{{ route('like') }}" : "{{ route('dislike') }}";

            try {
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

                const likeBtn = document.querySelector(`.btn-like[data-id='${id}']`);
                const dislikeBtn = document.querySelector(`.btn-dislike[data-id='${id}']`);

                if (tipo === 'like') {
                    likeBtn.classList.add('ativo');
                    dislikeBtn.classList.remove('ativo');
                } else {
                    dislikeBtn.classList.add('ativo');
                    likeBtn.classList.remove('ativo');
                }
            } catch(err) {
                console.error("Erro no like/dislike:", err);
            }
        });
    });

    
    document.querySelectorAll('.btn-chat').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const inputDiv = document.getElementById(`input-comentario-${id}`);
            inputDiv.style.display = inputDiv.style.display === 'none' ? 'flex' : 'none';
            if(inputDiv.style.display === 'flex') inputDiv.querySelector('input').focus();
        });
    });

    document.querySelectorAll('.btn-comentar').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            const input = document.querySelector(`.input-comentario[data-id='${id}']`);
            const texto = input.value.trim();
            if (!texto) return;

            try {
                const res = await fetch("{{ route('comentar') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ publicacao_id: id, texto })
                });

                if (res.status === 401) return modal.style.display = "flex";

                const data = await res.json();
                const comentariosDiv = document.getElementById(`comentarios-${id}`);
                const div = document.createElement('div');
                div.classList.add('comentario');
                div.style.opacity = 0;
                div.innerHTML = `<strong>${data.comentario.usuario}:</strong> ${data.comentario.texto}`;
                comentariosDiv.appendChild(div);

                
                let op = 0;
                const timer = setInterval(() => {
                    if(op >= 1) clearInterval(timer);
                    div.style.opacity = op;
                    op += 0.1;
                }, 30);

                input.value = '';
            } catch(err) {
                console.error("Erro ao comentar:", err);
            }
        });
    });

});
</script>

</body>
</html>
