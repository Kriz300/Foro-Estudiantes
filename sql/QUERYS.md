#LISTA QUERYS POR HACER

#SELECT:

#a partir de un rut extraer nombre(curso) y 3 ultimos hilos del curso
```
SELECT cursos.nombre, hilos.id, hilos.titulo from cursos,hilos,usuarios_cursos
WHERE usuarios_cursos.rut = $1 and usuarios_cursos.sigla = cursos.sigla
and hilos.sigla = usuarios_cursos.sigla ORDER BY id DESC limit 3;
```

#todos los nombres de cursos no inscritos
```

```
#dado un rut listar las url de todos los archivos subidos
```
SELECT archivos.url FROM archivos WHERE archivos.rut = $1;
```
#dada una sigla listar las url de todos los archivos subidos
```
SELECT archivos.url FROM archivos WHERE archivos.sigla = $1;
```
#dado un rut y una sigla listar las url de todos los archivos subidos
```
SELECT archivos.url FROM archivos WHERE archivos.rut = $1 and arhivos.sigla = $2;
```
#dado un curso devolver todos los hilos
```
SELECT hilos.id, hilos.titulo FROM hilos where hilos.sigla = $1;
```
#dado un hilo devolver todos los comentarios
```
SELECT comentarios.id, comentarios.cuerpo FROM comentarios 
WHERE comentarios.id_hilo = $1;
```
#dado un comentario devolver todas las respuestas
```
SELECT comentarios.id, comentarios.cuerpo FROM comentarios 
WHERE comentarios.id_respondido = $1;
```
#Dado id cuantos likes tiene comentario, hilos
```
SELECT hilos.likes FROM hilos WHERE hilos.id = $1;
SELECT comentarios.likes FROM comentarios WHERE comentarios.id = $1;
```

#Dado rut, id ver si tiene like o dislike
```
SELECT Estado_like_hilo.EstadoL,Estado_like_hilo.EstadoD FROM Estado_like_hilo
WHERE Estado_like_hilo.rut = $1, Estado_like_hilo.ID_post = $2;

SELECT Estado_like_Comentario.EstadoL,Estado_like_Comentario.EstadoD 
FROM Estado_like_Comentario
WHERE Estado_like_Comentario.rut = $1, Estado_like_Comentario.ID_post = $2;
```

#INSERT:

#crear uno para cada tabla ej: nuevo usuario
```
INSERT INTO Usuarios VALUE ($1,$2,$3,$4);
INSERT INTO Cursos VALUE ($1,$2,$3);
INSERT INTO Usuarios_Cursos VALUE (default,$1,$2,$3,$4,$5,$6,$7)
INSERT INTO Archivos VALUE (default,$1,$2,$3,$4);
INSERT INTO Hilos VALUE (default,$1,$2,$3,$4,$5,$6,$7);
INSERT INTO Comentarios VALUE (default,$1,$2,$3,$4,$5);
INSERT INTO Notificaciones VALUE (default,$1,$2,$3,$4,$5);
```
#UPDATE:

#actualizar likes
```
UPDATE Hilos SET Likes = $2  WHERE hilos.id=$1;
UPDATE Comentarios SET Likes = $2  WHERE comentarios.id=$1;
```
#actualizar dislikes
```
UPDATE Hilos SET dislike = $2  WHERE hilos.id=$1;
UPDATE Comentarios SET dislike = $2  WHERE comentarios.id=$1;
```
#actualizar estado de notificacion cuando se lee
```
UPDATE Notificaciones SET estado = 1 WHERE estado = 0 and Notificaciones = $1;
```
#cambio de contraseña
```
UPDATE Usuarios SET clave = $2 WHERE usuarios.id = $1; 
```