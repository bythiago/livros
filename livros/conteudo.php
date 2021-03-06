<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <title>Hello, world!</title>
</head>
<body>
<div class="row">
    <div class="container">
        <div class="col-md-12">
            <h1>Livros</h1>

            <table class="table table-bordered table-sm table-hover">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
                <?php foreach ($livros as $livro):?>
                    <tr>
                        <td><?=$livro['id'];?></td>
                        <td><?=$livro['titulo'];?></td>
                        <td>
                            <button type="button" data-id="<?=$livro['id'];?>" data-titulo="<?=$livro['titulo'];?>" class="btn-editar btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                Editar
                            </button>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Livros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-editar">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Título</label>
                        <input id="titulo" type="text" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-salvar">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        var dados = {}, $titulo = $("#titulo");

        $(".btn-editar").click(function (e) {
            dados['id'] = $(this).data('id');
            $titulo.val($(this).data('titulo'));
        });

        $(".btn-salvar").click(function (e){
            dados['titulo'] = $titulo.val();
            enviaDados(dados);
        });

        function enviaDados(dados){
            $.ajax({
                url: "update.php",
                method: "POST",
                data: dados
            }).done(function(response) {
                alert(response.message);
                window.location.reload();
            });
        }
    });
</script>

<!-- Optional JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
