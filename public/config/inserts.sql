INSERT INTO `ph_categories`(`id`, `description`) VALUES (1, 'PELIGRO'), (2, 'ALERTA'), (3, 'BUENO')

% This is for postgresql %
INSERT INTO ph_list( value, creation_date ,category_id) values( 1.56, current_timestamp ,1)

% Remove all rows of a table and restart id %
truncate table ph_list restart IDENTITY