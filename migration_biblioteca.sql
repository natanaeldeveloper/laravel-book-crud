create table livros (
	id serial not null primary key,
	titulo varchar(255) not null,
	isbn varchar(11) not null,
	ano_lancamento integer not null,
	nome_autor varchar(255) not null,
	created_at timestamp,
	updated_at timestamp
);

alter table livros alter column id set default nextval('livros_id_seq'::regclass);