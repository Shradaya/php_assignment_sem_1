CREATE TABLE IF NOT EXISTS comments (
    id int generated always as identity,
    user_name varchar(256),
    comment text,
    time timestamp default now(),
    primary key (id)
);

-- INSERT QUERIES
INSERT INTO public.comments (user_name, comment, time) VALUES ('Ramtel', 'Interesting Stuffs, keep posting more', '2023-01-29 11:05:06.885422');
INSERT INTO public.comments (user_name, comment, time) VALUES ('Shradaya', 'Please add more on the components as well.', '2023-01-29 10:49:47.257953');
INSERT INTO public.comments (user_name, comment, time) VALUES ('Shradaya', 'Hello World', '2023-01-29 10:45:47.257953');