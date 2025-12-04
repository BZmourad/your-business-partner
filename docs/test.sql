SET @p = 1;
/*DELETE FROM role_has_permissions WHERE role_id = 2 AND permission_id = @p;

INSERT INTO role_has_permissions(permission_id, role_id) VALUES(@p,2);*/
SELECT p.id, p.`name` 
FROM role_has_permissions rp
JOIN permissions p ON p.id = rp.permission_id
WHERE rp.role_id = 2;
SELECT * FROM permissions;