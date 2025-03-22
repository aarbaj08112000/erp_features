UPDATE `customer_parts_master`
SET `fg_stock` = 0

UPDATE `customer_part`
SET `fg_stock` = 0

UPDATE `child_part`
SET `stock` = 0, 
`rejection_prodcution_qty` = 0 ,
`production_qty` =0,
`sub_con_stock` =0, 
`rejection_stock` =0, 
`sharing_qty` =0,
`production_scrap` =0,
`production_rejection` =0

Update `child_part_master`
SET `onhold_stock` = 0, `stock` = 0

UPDATE `inhouse_parts`
SET `stock` = 0,
`production_qty` = 0,
`rejection_prodcution_qty`= 0, 
`production_scrap`= 0,
`production_rejection` = 0 


/**

UPDATE `customer_parts_master`
SET `fg_stock` = 1000;

UPDATE `customer_part`
SET `fg_stock` = 1000;

UPDATE `child_part`
SET `stock` = 1000;

Update `child_part_master`
SET`stock` = 1000;

UPDATE `inhouse_parts`
SET `stock` = 1000;

*/