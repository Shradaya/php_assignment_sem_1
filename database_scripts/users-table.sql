CREATE TABLE IF NOT EXISTS users (
  user_id int GENERATED ALWAYS AS IDENTITY,
  user_name varchar(255) UNIQUE ,
  user_password_hash varchar(255),
  user_email varchar(255) UNIQUE,
  PRIMARY KEY (user_id)
);

-- INSERT INTO users
INSERT INTO public.users (user_name, user_password_hash, user_email) VALUES ('Shradaya', '$2y$10$/IAmQYp90Tr8OccA1x23GeQA1V67GqKi9pQvGKyyoHOCYM66ZRNoG', 'shradaya@hotmail.com');
INSERT INTO public.users (user_name, user_password_hash, user_email) VALUES ('Ramtel', '$2y$10$8ZeAW7QF1uIqxwGLUkuqoOIb87vBbFqZr68GGmieqDrvtaiBT4A3C', 'ramtel@gmail.com');