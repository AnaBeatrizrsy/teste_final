<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Sistema de Controle Academico')</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main>  
        <div class= "container">
            <ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ route('aluno.store') }}" >Aluno</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('professor.store') }}">Professor</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('aluno.create') }}">Cadastro Aluno</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('professor.create') }}">Cadastro Professor</a>
  </li>
  <li class= "nav-item">
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Sair</button>
    </form>
  </li>
  
</ul>
        </div>
        @yield('content') 
    </main>
    
    <footer>
        <p>&copy: 2025 - Todos os Direitos Reservados</p>
    </footer>
</body>
</html>