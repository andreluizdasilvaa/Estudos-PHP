<?php
$tarefas = [];

$host = "localhost or addr";
$user = "seu_user";
$senha = "sua_senha";
$banco = "seu_banco";

$conn = new mysqli($host, $user, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão com o banco: " . $conn->connect_error);
}

// Id da tarefa que acabou de ser salva (vem na URL: ?salvo=5). 0 = nenhuma.
$salvoId = isset($_GET['salvo']) ? intval($_GET['salvo']) : 0;

// Criação ou atualização das tarefas (antes do SELECT e sem nenhum echo antes do header)

// Verifica se é o metodo POST e se tem o campo 'descricao'.
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['descricao'])) {

    if (!empty($_POST['id'])) {
        // ATUALIZAR: veio o campo hidden 'id'
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("UPDATE tarefa SET descricao = ? WHERE id = ?");
        $stmt->bind_param("si", $_POST['descricao'], $id);
        // volta para a página avisando qual tarefa foi salva
        $destino = "todo_crud_mysql.php?salvo=" . $id;
    } else {
        // CRIAR: sem 'id'
        $stmt = $conn->prepare("INSERT INTO tarefa (descricao) VALUES (?)");
        $stmt->bind_param("s", $_POST['descricao']);
        $destino = "todo_crud_mysql.php";
    }

    // Executa a query e se retornar true, recarrega a pagina e finaliza a execução.
    if ($stmt->execute()) {
        header("Location: " . $destino);
        exit;
    }
}

// Buscar as tarefas
// Faz uma busca direta no banco sem o prepared_statement (model)
$result = $conn->query("SELECT * FROM tarefa ORDER BY tempo_criacao DESC");

// Verifica se o resultado é true e tem linhas/dados
if ($result && $result->num_rows > 0) {

    // coloca em $row todas as linhas retornadas da tabela usando fetch_assoc para transformala em obj
    while ($row = $result->fetch_assoc()) {
        // vai adicionando (push) cada linha retornada da tabela dentro do array tarefas
        $tarefas[] = $row;
    }
}

// Exclusão das tarefas
// Verifica se tem o parametro 'delete' na url: [...]/?delete=xyz
if (isset($_GET['delete'])) {
    $loading = true;
    // Converte o valor da URL para INT (por padrão vem string, aqui nos convertemos com 'intval')
    $id = intval(value: $_GET['delete']);

    // query para deletar a tarefa com base no ID
    $sqldelete = "DELETE FROM tarefa WHERE id = $id";

    // roda a query e se retornar true recarrega a pagina e finaliza a execução.
    if ($conn->query(query: $sqldelete) === true) {
        header("Location: todo_crud_mysql.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📋</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles_todo.css">
</head>

<body>

    <?php if ($salvoId > 0): ?>
        <!-- Aviso que aparece e some sozinho -->
        <div class="toast" role="status">Tarefa atualizada!</div>
    <?php endif; ?>

    <main class="container">
        <h1 class="header-title">Tarefas</h1>

        <form class="create-task-form" action="todo_crud_mysql.php" method="POST">
            <label class="form-label" for="tarefa">Nova tarefa</label>
            <div class="input-group">
                <input class="input-field" type="text" name="descricao" id="tarefa" placeholder="Ex: Finalizar relatório..." autocomplete="off" required>
                <button class="btn-primary" type="submit">Adicionar</button>
            </div>
        </form>

        <div class="section-header">
            <h2 class="section-title">Minha Lista</h2>
        </div>

        <?php if (!empty($tarefas)): ?>
            <ul class="task-list">
                <?php foreach ($tarefas as $tarefa): ?>
                    <!-- A classe 'saved' só entra na tarefa que acabou de ser salva -->
                    <li class="task-item<?= (int)$tarefa['id'] === $salvoId ? ' saved' : '' ?>">
                        <form class="edit-form" action="todo_crud_mysql.php" method="POST">
                            <input type="hidden" name="id" value="<?= (int)$tarefa['id'] ?>">
                            <input class="edit-input" type="text" name="descricao" value="<?= htmlspecialchars($tarefa['descricao'], ENT_QUOTES, 'UTF-8') ?>" required>
                            <button class="btn-save" type="submit">Salvar</button>
                        </form>
                        <a class="btn-delete" href="todo_crud_mysql.php?delete=<?= (int)$tarefa['id'] ?>" title="Excluir tarefa">Excluir</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="empty-state">
                <span>Nenhuma tarefa cadastrada no momento.</span>
            </div>
        <?php endif; ?>
    </main>

    <script>
        // Tira o ?salvo=... da URL para a animação não repetir se der F5
        if (location.search.includes('salvo=')) {
            history.replaceState(null, '', location.pathname);
        }

        document.querySelectorAll('.btn-delete').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.dataset.loading) {
                    e.preventDefault();
                    return;
                }
                this.dataset.loading = "true";
                this.textContent = "Excluindo...";
            });
        });
    </script>
</body>

</html>