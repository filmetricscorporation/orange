INSERT INTO ohrm_menu_item (screen_id, menu_title, parent_id, level, order_hint, status)
VALUES (NULL, 'Configure', NULL, '2', '100', '1');

-- change heirarchy in order to set Configure as first menu
UPDATE ohrm_menu_item SET order_hint = 200 WHERE id = 66;
UPDATE ohrm_menu_item SET order_hint = 300 WHERE id = 67;

INSERT INTO ohrm_menu_item (screen_id, menu_title, parent_id, level, order_hint, status)
VALUES ('61', 'Application Sources', 95, '3', '100', '1');
