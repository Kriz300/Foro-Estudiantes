create table Usuarios(
	Rut varchar(10) not null,
	Nombre varchar(50),
	Clave varchar(20),
	Email varchar(50),
	primary key (Rut)
);

create table Cursos(
	Sigla varchar(20) not null,
	Nombre varchar(50),
	Capacidad int,
	primary key (Sigla)
);

create table Usuarios_Cursos(
	ID int not null,
	Rut varchar(10),
	Sigla varchar(20),
	Anyo int,
	Semestre int,
	Tipo_Usuario int,
	Estado_del_Curso int,
	Nota_Final varchar(4),
	primary key (ID),
	foreign key (Rut) references Usuarios (Rut),
	foreign key (Sigla) references Cursos (Sigla)
);

create table Archivos(
	ID int not null,
	Rut varchar(10),
	Sigla varchar(20),
	URL varchar(50),
	Tipo varchar(10),
	primary key (ID),
	foreign key (Rut) references Usuarios (Rut),
	foreign key (Sigla) references Cursos (Sigla)
);

create table Hilos(
	ID int not null,
	Rut varchar(10),
	Sigla varchar(20),
	Titulo varchar(20),
	Tag varchar(50),
	Cuerpo varchar(101),
	Likes int,
	Dislike int,
	primary key (ID),
	foreign key (Rut) references Usuarios (Rut),
	foreign key (Sigla) references Cursos (Sigla)
);

create table Comentarios(
	ID int not null,
	Rut varchar(10),
	ID_Hilo int,
	ID_Respondido int,
	Cuerpo varchar(101),
	Likes int,
	Dislike int,
	primary key (ID),
	foreign key (Rut) references Usuarios (Rut),
	foreign key (ID_Hilo) references Hilos (ID)
);

create table Notificaciones(
	ID int not null,
	Rut varchar(10),
	ID_Hilo int,
	Sigla varchar(20),
	Tipo int,
	Estado int,
	Fecha timestamp,
	primary key (ID),
	foreign key (Rut) references Usuarios (Rut),
	foreign key (Sigla) references Cursos (Sigla)
);