var tbBebidas = window.document.getElementById('tbBebidas')
var resTabelas = window.document.getElementById('resultTabelas')
resTabelas.innerHTML = 'a <table id="tbBebidas" name="tbBebidas" class="table table-bordered table-striped">'+
                  '<thead>'+
                    '<tr>'+
                        '<th>Foto</th>'+
                        '<th>Nome</th>'+
                        '<th>Volume (ml)</th>'+
                        '<th>Descrição</th>'+
                        '<th>Preço</th>'+
                        '<th>Ações</th>'+
                    '</tr>'+
                  '</thead>'+
                  '<tbody>'+

                    '<tr>'+
                        '<td style="text-align:center;"><img style="width: 55px; border-radius: 100%" src="../img/bebidas/"></td>'+
                        '<td style="vertical-align: middle;"><?php echo $show->nome_bebida;?></td>'+
                        '<td style="vertical-align: middle;">Volume (ml)</td>'+
                        '<td style="vertical-align: middle;">Descrição</td>'+
                        '<td style="vertical-align: middle;">Preço</td>'+
                        '<td style="vertical-align: center; vertical-aline: middle;">'+
                          '<a href="editar_produto.php" title="Editar" class="btn btn-success"><img style="width: 15px;" src="../img/svg/editar.png" alt=""></a>'+
                          '<a href="deletar.php?idDell> onclick="returne title="remover" class=" btn btn-danger"><img style="width: 15px;" src="../img/svg/remover.png" alt=""></a>'+
                        '</td>'+
                    '</tr>'+
                  '</tbody'+
                  '<tfoot>'+
                    '<tr>'+
                        '<th>Foto</th>'+
                        '<th>Nome</th>'+
                        '<th>Volume (ml)</th>'+
                        '<th>Descrição</th>'+
                        '<th>Preço</th>'+
                        '<th>Ações</th>'+
                    '</tr>'+
                  '</tfoot>'+
                '</table>'