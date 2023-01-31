CREATE TABLE messages(
    id int generated always as identity,
    user_name varchar(256),
    message text,
    time timestamp default now()
);

-- INSERT DATA INTO TABLE
INSERT INTO public.messages (user_name, message, time) VALUES ('Shradaya', 'Hello Its a test Message.', '2023-01-29 12:17:40.593748');