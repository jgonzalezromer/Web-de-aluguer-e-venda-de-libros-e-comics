# Web-de-aluguer-e-venda-de-libros-e-comics
Para facer a conexión coa base de datos utilicei o porto 3308 para cambialo hai que ir ao arquivo "./Models/connect.php"

Utilizamos como base de datos:

A base de datos chamarase: catalogo
Incluirá as siguientes táboas:

 Táboa usuario (usuario (varchar 24), contrasinal (varchar 8), nome
 (varchar60), direccion (varchar 90), telefono (int), nifdni(varchar 9),
 tipo_usuario(char(1)) )

 Táboa novo_rexistro (usuario (varchar 24), contrasinal (varchar 8),
 nome (varchar 60), direccion (varchar 90), telefono (int),
 nifdni(varchar 9))

 Táboa libro_aluguer (titulo (varchar 80), cantidade (int),
 descripcion (varchar120), editorial (varchar 24), prezo (int), foto
 (varchar 1000) )

 Táboa libro_alugado (titulo (varchar 80), cantidade (int),
 descripcion (varchar120), editorial (varchar 24), foto (varchar 1000) ,
 usuario (varchar 24))

 Táboa libro_devolto (titulo(varchar 80), cantidade (int),
 descripcion (varchar120), editorial (varchar 24), foto (varchar 1000) ,
 usuario (varchar 24)))

 Táboa libro_venda (titulo (varchar 80), cantidade (int), descripcion
 (varchar120), editorial (varchar 24), prezo (int), foto (varchar 1000) )