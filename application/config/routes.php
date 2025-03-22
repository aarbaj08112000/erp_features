<?php
defined('BASEPATH') or exit('No direct script access allowed');

#------------ Login -----------------------------
$route['default_controller'] = 'LogonDashboard/login';
$route['login'] = 'LogonDashboard/login';
$route['logout'] = 'LogonDashboard/logout';
$route['signin'] = 'LogonDashboard/signin';
$route['index'] = 'LogonDashboard/index';
$route['dashboard'] = 'Dashboard/dashboard';
$route['sitemap'] = 'LogonDashboard/sitemap';
// $route['dashboard_new'] = 'Dashboard/dashboard';
$route['home_2'] = 'LogonDashboard/home_2';

$route['downtime_master'] = 'welcome/downtime_master';

#--------------- Rejection ---------------------
$route['rejection_invoices/(:any)'] = 'SalesController/rejection_invoices';
$route['rejection_invoices'] = 'SalesController/rejection_invoices';
$route['generate_new_sales_rejection_Test'] = 'SalesController/generate_new_sales_rejection_Test';
$route['generate_rejection_sales_invoice'] = 'SalesController/generate_rejection_sales_invoice';
$route['view_rejection_sales_invoice_by_id/(:any)'] = 'SalesController/view_rejection_sales_invoice_by_id';
$route['update_rejection_sales_invoice'] = 'SalesController/update_rejection_sales_invoice';
$route['generate_rejection_flow'] = 'welcome/generate_rejection_flow';
#-------------- Added by Aarbaj
$route['generate_credit_note/(:any)/(:any)'] = 'SalesController/generate_credit_note';
$route['generate_credit_note_multiple/(:any)'] = 'SalesController/generate_credit_note_multiple';
#--------------- Production --------------------
$route['update_production_qty'] = 'Welcome/update_production_qty';
$route['transfer_child_part_to_store_stock'] = 'Welcome/transfer_child_part_to_store_stock';


#--------------------- STOCK  ------------
$route['part_stocks'] = 'StockController/part_stocks_view';
$route['view_part_stocks'] = 'StockController/view_part_stocks';
$route['transfer_child_store_to_store_stock'] = 'StockController/transfer_child_store_to_store_stock';
$route['transfer_child_store_to_store_stock_view'] = 'StockController/transfer_child_store_to_store_stock_view';
$route['transfer_child_part_to_fg_stock'] = 'StockController/transfer_child_part_to_fg_stock';
$route['update_production_qty_child_part'] = 'StockController/update_production_qty_child_part';
$route['transfer_child_part_to_fg_stock_inhouse'] = 'StockController/transfer_child_part_to_fg_stock_inhouse';
$route['sharing_issue_request_store'] = 'StockController/sharing_issue_request_pending';
$route['sharing_issue_request_store_completed'] = 'StockController/sharing_issue_request_store_completed';



#--------------------- COMMON PRODUCTION ------------
#$route['transfer_child_store_to_store_stock'] = 'ProductionController/transfer_child_store_to_store_stock';


#--------------------- SHEET METAL PRODUCTION ------------
$route['update_production_qty_child_part_production_qty'] = 'SheetProdController/update_production_qty_child_part_production_qty';
$route['p_q'] = 'SheetProdController/p_q';
$route['p_q_add'] = 'SheetProdController/production_qty_add';
$route['add_production_qty'] = 'SheetProdController/add_production_qty';
$route['update_p_q_onhold'] = 'SheetProdController/update_p_q_onhold';
$route['details_production_qty/(:any)'] = 'SheetProdController/details_production_qty';
$route['add_production_qty_sharing'] = 'SheetProdController/add_production_qty_sharing';
$route['update_p_q_sharing'] = 'SheetProdController/update_p_q_sharing';
$route['add_sharing_issue_request'] = 'SheetProdController/add_sharing_issue_request';
$route['accept_sharing_request'] = 'SheetProdController/accept_sharing_request';
$route['add_sharing_p_q_history'] = 'SheetProdController/add_sharing_p_q_history';
$route['update_p_q_onhold_sharing'] = 'SheetProdController/update_p_q_onhold_sharing';
$route['final_inspection_qty_add'] = 'SheetProdController/final_inspection_qty_add';






$route['view_p_q'] = 'SheetProdController/view_p_q';
$route['sharing_p_q'] = 'SheetProdController/sharing_p_q';
$route['sharing_issue_request'] = 'SheetProdController/sharing_issue_request';
$route['details_production_qty_sharing/(:any)'] = 'SheetProdController/details_production_qty_sharing';




#----------------- PLASTIC PRODUCTION --------------
#$route['update_production_qty_child_part'] = 'PlasticProdController/update_production_qty_child_part';




$route['delete_po'] = 'welcome/delete_po';
$route['delete_po_sub'] = 'welcome/delete_po_sub';

#------------------ Masters ---------------------
$route['configs'] = 'GlobalConfigController/listconfigs';
$route['add_new_config'] = 'GlobalConfigController/addConfig';
$route['edit_config'] = 'GlobalConfigController/editConfig';

$route['uom'] = 'MasterController/uom';
$route['part_type'] = 'welcome/part_type';
$route['adduom'] = 'MasterController/adduom';
$route['updateuom'] = 'MasterController/updateuom';
$route['client'] = 'MasterController/client';
$route['addClient'] = 'MasterController/addClient';
$route['updateClient'] = 'MasterController/updateClient';
$route['consignee'] = 'MasterController/consignee';
$route['add_consignee'] = 'MasterController/add_consignee';
$route['update_consignee'] = 'MasterController/update_consignee';

$route['addpartType'] = 'welcome/addpartType';
$route['updatepartType'] = 'welcome/updatepartType';

$route['customer'] = 'welcome/customer';
$route['customer_master'] = 'welcome/customer_master';
$route['inwarding'] = 'welcome/inwarding';
$route['inwarding_by_po'] = 'welcome/inwarding_by_po';
$route['inwarding_po_check'] = 'welcome/inwarding_po_check';

//Reports
$route['report_stock_transfer'] = 'Welcome/report_stock_transfer';
$route['reports_po_balance_qty'] = 'Welcome/reports_po_balance_qty';
$route['report_prod_rejection'] = 'P_Molding/report_prod_rejection';
$route['reports_inspection'] = 'Welcome/reports_inspection';
$route['pei_chart_sales_values_in_rs'] = 'Welcome/pei_chart_sales_values_in_rs';
$route['reports_incoming_quality'] = 'Welcome/reports_incoming_quality';
// erp improvement
$route['downtime_report'] = 'P_Molding/downtime_report';
$route['filter_downtime_report'] = 'P_Molding/filter_downtime_report';

//new controller
$route['generate_new_po'] = 'Newcontroller/generate_new_po';
$route['issueJobCard'] = 'Welcome/issueJobCard';
$route['generate_new_po_sub'] = 'Newcontroller/generate_new_po_sub';
$route['generate_new_sales_subcon'] = 'Newcontroller/generate_new_sales_subcon';
$route['view_new_po_by_id/(:any)'] = 'Newcontroller/view_new_po_by_id';

$route['view_new_po_by_id_sub/(:any)'] = 'Newcontroller/view_new_po_by_id_sub';
$route['view_challan_by_id_subcon/(:any)'] = 'Newcontroller/view_challan_by_id_subcon';
$route['generate_challan_subcon'] = 'Newcontroller/generate_challan_subcon';

$route['view_new_sales_by_id_subcon/(:any)'] = 'Newcontroller/view_new_sales_by_id_subcon';
$route['view_new_sales_by_id_rejection/(:any)'] = 'Newcontroller/view_new_sales_by_id_rejection';
$route['view_rejection_flow/(:any)'] = 'Newcontroller/view_rejection_flow';

$route['inwarding_details/(:any)/(:any)'] = 'Welcome/inwarding_details';
$route['inwarding_details_validation/(:any)/(:any)'] = 'Welcome/inwarding_details_validation';
$route['inwarding_details_accept_reject/(:any)/(:any)'] = 'Welcome/inwarding_details_accept_reject';
$route['update_rm_batch_mtc_report'] = 'Welcome/update_rm_batch_mtc_report';
$route['add_po_parts'] = 'Newcontroller/add_po_parts';
$route['edit_grn_qty_val'] = 'Newcontroller/edit_grn_qty';

$route['add_challan_parts_history'] = 'Newcontroller/add_challan_parts_history';
$route['add_challan_parts_history_subcon'] = 'Newcontroller/add_challan_parts_history_subcon';
$route['add_challan_parts_history_challan'] = 'Newcontroller/add_challan_parts_history_challan';
$route['update_challan_parts_history_challan'] = 'Newcontroller/update_challan_parts_history_challan';
$route['add_po_parts_sub'] = 'Newcontroller/add_po_parts_sub';
$route['add_sales_parts_subcon'] = 'Newcontroller/add_sales_parts_subcon';
$route['add_parts_rejection_sales_invoice'] = 'Newcontroller/add_parts_rejection_sales_invoice';
$route['add_grn_qty_subcon_view'] = 'Welcome/add_grn_qty_subcon_view';
$route['add_grn_qty_subcon_view_customer_challan/(:any)/(:any)'] = 'Welcome/add_grn_qty_subcon_view_customer_challan';
$route['update_grn_qty'] = 'Newcontroller/update_grn_qty';
$route['update_grn_qty_accept_reject'] = 'Newcontroller/update_grn_qty_accept_reject';
$route['accept_inwarding_data'] = 'Newcontroller/accept_inwarding_data';
$route['validate_invoice_amount'] = 'Newcontroller/validate_invoice_amount';
$route['update_po_parts'] = 'Newcontroller/update_po_parts';
$route['AmendQty'] = 'Newcontroller/AmendQty';
$route['update_po'] = 'Newcontroller/update_po';
$route['update_parts_customer_trackings'] = 'Newcontroller/update_parts_customer_trackings';
$route['update_schedule_qty'] = 'Newcontroller/update_schedule_qty';
$route['update_sales_parts_subcon'] = 'Newcontroller/update_sales_parts_subcon';
$route['update_parts_rejection_sales_invoice_qty'] = 'Newcontroller/update_parts_rejection_sales_invoice';
$route['update_challan_parts'] = 'Newcontroller/update_challan_parts';
$route['update_challan_parts_subcon'] = 'Newcontroller/update_challan_parts_subcon';
$route['accept_po'] = 'Newcontroller/accept_po';
$route['unlock_po'] = 'Newcontroller/unlock_po';
$route['accept_customer_po_tracking'] = 'Newcontroller/accept_customer_po_tracking';
$route['accept_po_sub'] = 'Newcontroller/accept_po_sub';
$route['lock_invoice_subcon'] = 'Newcontroller/lock_invoice_subcon';
$route['lock_invoice_rejection'] = 'Newcontroller/lock_invoice_rejection';
$route['lock_invoice_rejection_new'] = 'Newcontroller/lock_invoice_rejection_new';
$route['lock_parts_rejection_sales_invoice'] = 'Newcontroller/lock_parts_rejection_sales_invoice';
$route['new_po_list_supplier'] = 'Newcontroller/new_po_list_supplier';
$route['new_po_list_supplier_sub'] = 'Newcontroller/new_po_list_supplier_sub';
$route['view_po_by_supplier_id/(:any)'] = 'Newcontroller/view_po_by_supplier_id';
$route['view_po_by_supplier_id_sub/(:any)'] = 'Newcontroller/view_po_by_supplier_id_sub';
$route['pending_po'] = 'Newcontroller/pending_po';
$route['expired_po'] = 'Newcontroller/expired_po';
$route['closed_po'] = 'Newcontroller/closed_po';
$route['rejected_po'] = 'Newcontroller/rejected_po';
$route['close_po'] = 'Newcontroller/close_po';
$route['close_po_customer_po_tracking'] = 'Newcontroller/close_po_customer_po_tracking';

$route['import_shedule_part'] = 'Excel_import/import_shedule_part';
$route['bom'] = 'welcome/bom';
$route['new_po'] = 'welcome/new_po';

$route['new_po_sub'] = 'welcome/new_po_sub';
$route['new_sales_subcon'] = 'welcome/new_sales_subcon';
$route['new_sales_rejection'] = 'welcome/new_sales_rejection';

$route['rejection_flow'] = 'welcome/rejection_flow';
$route['addbom'] = 'welcome/addbom';
$route['add_subcon_bom'] = 'welcome/add_subcon_bom';
$route['add_subcon_bom_customer_bom'] = 'welcome/add_subcon_bom_customer_bom';
$route['add_operations_bom'] = 'welcome/add_operations_bom';
$route['add_rejection_new'] = 'welcome/add_rejection_new';
$route['add_operations_bom_inputs'] = 'welcome/add_operations_bom_inputs';
$route['update_operations_bom_output'] = 'welcome/update_operations_bom_output';
$route['update_operations_bom_inputs'] = 'welcome/update_operations_bom_inputs';
$route['updatebom'] = 'welcome/updatebom';
$route['update_subcon_bom'] = 'welcome/update_subcon_bom';

$route['add_part'] = 'welcome/add_part';

$route['routing'] = 'welcome/routing';
$route['routing_customer'] = 'welcome/routing_customer';

$route['purchase_order'] = 'welcome/purchase_order';
$route['planing_data_report'] = 'welcome/planing_data_report';
$route['subcon_supplier_challan_part_report'] = 'welcome/subcon_supplier_challan_part_report';
$route['customer_part_wip_stock_report'] = 'welcome/customer_part_wip_stock_report';
$route['planing_data_report_view'] = 'welcome/planing_data_report_view';
$route['planning_year_page'] = 'welcome/planning_year_page';
$route['transfer_stock/(:any)'] = 'welcome/transfer_stock';
$route['final_inspection_stock_transfer_click/(:any)'] = 'welcome/final_inspection_stock_transfer_click';
$route['update_rejection_flow_status'] = 'welcome/update_rejection_flow_status';
$route['addPurchaseOrder'] = 'welcome/addPurchaseOrder';
$route['updatePurchaseOrder'] = 'welcome/updatePurchaseOrder';
$route['change_challan_status'] = 'welcome/change_challan_status';
$route['change_challan_status_subcon'] = 'welcome/change_challan_status_subcon';
$route['category'] = 'welcome/category';
$route['add_category'] = 'welcome/add_category';
$route['update_category'] = 'welcome/update_category';

// $route['add_part'] = 'welcome/add_part';

########################### PLANNING ######################################
$route['planing_data_month/(:any)'] = 'PlanningController/planing_data_month';
$route['planing_data/(:any)/(:any)/(:any)'] = 'PlanningController/planing_data';
$route['get_customer_parts_for_planning'] = 'PlanningController/get_customer_parts_for_planning';
$route['add_planning_data'] = 'PlanningController/add_planning_data';
$route['add_planning_fg_stock'] = 'PlanningController/add_planning_fg_stock';
$route['view_planing_data/(:any)'] = 'PlanningController/view_planing_data';
$route['update_planning_data'] = 'PlanningController/update_planning_data';
$route['view_all_child_parts_schedule/(:any)/(:any)'] = 'PlanningController/view_all_child_parts_schedule';
$route['update_schedule_qty'] = 'PlanningController/update_schedule_qty'; //NOT used due to schedule_qty2 not in use...
$route['planning_export_customer_part'] = 'PlanningController/planning_export_customer_part';
$route['import_customer_planning'] = 'PlanningController/import_customer_planning';
$route['planning_shop_order_details'] = 'PlanningController/planning_shop_order_details';
$route['add_planning_shop_order'] = 'PlanningController/add_planning_shop_order';

$route['download_my_pdf/(:any)'] = 'PdfControllertulsi/download_po';
$route['download_my_pdf_inspection_report/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'PdfControllertulsi/download_my_pdf_inspection_report';
$route['create_debit_note/(:any)'] = 'PdfControllertulsi/create_debit_note';
$route['generate_sales_invoice/(:any)/(:any)'] = 'PdfControllertulsi/generate_sales_invoice';
$route['print_sales_invoice/(:any)'] = 'PdfControllertulsi/print_sales_invoice';
$route['print_challan_invoice/(:any)'] = 'PdfControllertulsi/print_challan_invoice';

$route['gst'] = 'welcome/gst';
$route['add_gst'] = 'welcome/add_gst';

$route['pdfg'] = 'welcome/pdfg';
	$route['child_part'] = 'welcome/child_part';
$route['operation_bom'] = 'welcome/operation_bom';
$route['inhouse_parts'] = 'welcome/inhouse_parts';

$route['subcon_po_inwarding_history/(:any)'] = 'welcome/subcon_po_inwarding_history';
$route['operation_bom_add'] = 'welcome/operation_bom_add';
$route['child_part_supplier'] = 'welcome/child_part_supplier';
$route['view_child_part_supplier_by_filter'] = 'welcome/view_child_part_supplier_by_filter';

$route['view_supplier_by_filter'] = 'welcome/view_supplier_by_filter';
$route['get_parts_per_clientUnit'] = 'welcome/get_parts_per_clientUnit';
$route['view_challan_parts_history/(:any)/(:any)'] = 'welcome/view_challan_parts_history';
$route['view_challan_parts_history_subcon/(:any)/(:any)'] = 'welcome/view_challan_parts_history_subcon';

$route['child_part_supplier_report'] = 'welcome/child_part_supplier_report';

$route['child_part_supplier_view'] = 'welcome/child_part_supplier_view';

$route['view_view_child_part_supplier_by_filter'] = 'welcome/view_view_child_part_supplier_by_filter';

$route['update_gst_report'] = 'welcome/update_gst_report';

$route['child_part_supplier_admin'] = 'welcome/child_part_supplier_admin';
$route['child_part_documents'] = 'welcome/child_part_documents';
$route['routing'] = 'welcome/routing';
$route['view_add_challan_subcon'] = 'welcome/view_add_challan_subcon';
$route['add_operation_bom_data'] = 'welcome/add_operation_bom_data';
$route['add_sharing_bom'] = 'welcome/add_sharing_bom';
$route['view_supplier_challan'] = 'welcome/view_supplier_challan';
$route['view_supplier_challan_subcon'] = 'welcome/view_supplier_challan_subcon';
$route['view_supplier_challan_details/(:any)'] = 'welcome/view_supplier_challan_details';
$route['view_supplier_challan_details_subcon/(:any)'] = 'welcome/view_supplier_challan_details_subcon';
$route['view_supplier_challan_details_part_wise/(:any)'] = 'welcome/view_supplier_challan_details_part_wise';
$route['view_supplier_challan_details_part_wise_subcon/(:any)'] = 'welcome/view_supplier_challan_details_part_wise_subcon';
$route['addrouting/(:any)'] = 'welcome/addrouting';
$route['addrouting_customer_subcon/(:any)'] = 'welcome/addrouting_customer_subcon';
$route['insert_challan_history'] = 'welcome/insert_challan_history';
$route['addRoutingParts'] = 'welcome/addRoutingParts';
$route['editRoutingParts'] = 'welcome/editRoutingParts';
$route['addRoutingParts_subcon'] = 'welcome/addRoutingParts_subcon';

$route['add_challan_parts_subcon'] = 'welcome/add_challan_parts_subcon';
$route['stock_variance'] = 'welcome/part_stocks';
$route['addchildpart_supplier'] = 'welcome/addchildpart_supplier';
$route['updatechildpart'] = 'welcome/updatechildpart';
$route['update_gst'] = 'welcome/update_gst';
$route['updatechildpartNew'] = 'welcome/updatechildpartNew';
$route['updatechildpart_supplier'] = 'welcome/updatechildpart_supplier';
$route['updatechildpart_supplier_admin'] = 'welcome/updatechildpart_supplier_admin';

$route['update_part_drawings'] = 'Welcome/update_part_drawings';

$route['view_history_part/(:any)'] = 'Welcome/view_history_part';

# Customer -- Inspection
$route['view_inspection_parm_details/(:any)/(:any)'] = 'PartInspectionController/view_inspection_parm_details';
$route['add_inspection_parm_details'] = 'PartInspectionController/add_inspection_parm_details';
$route['update_inspection_parm_details'] = 'PartInspectionController/update_inspection_parm_details';
$route['view_PDI_inspection_report/(:any)'] = 'PartInspectionController/view_PDI_inspection_report';
$route['auto_submit_inspection_report_observations/(:any)'] = 'PartInspectionController/auto_submit_inspection_report_observations';
$route['edit_inspection_parm_report_form'] = 'PartInspectionController/edit_inspection_parm_report_form';
$route['update_inspection_report_observations'] = 'PartInspectionController/update_inspection_report_observations';
$route['view_PDI/(:any)'] = 'PartInspectionController/view_PDI';

//part creation
$route['add_part_creation'] = 'Welcome/add_part_creation';
$route['add_part_creation2'] = 'Welcome/add_part_creation2';

$route['customer_part_price/(:any)'] = 'welcome/customer_part_price_by_id';
$route['customer_part_operation/(:any)/(:any)'] = 'welcome/customer_part_operation_by_id';

$route['update_customer_po_tracking_all'] = 'Newcontroller/update_customer_po_tracking_all';
$route['update_po_parts_amendment'] = 'Newcontroller/update_po_parts_amendment';
$route['update_po_parts_amendment_sub'] = 'Newcontroller/update_po_parts_amendment_sub';
$route['update_po_parts_amendment_approve'] = 'Newcontroller/update_po_parts_amendment_approve';
$route['update_po_parts_amendment_approve_sub'] = 'Newcontroller/update_po_parts_amendment_approve_sub';

$route['updatecustomerpart'] = 'welcome/updatecustomerpart';
$route['updatecustomerpartprice'] = 'welcome/updatecustomerpartprice';
$route['view_part_rate_history/(:any)'] = 'welcome/view_part_rate_history';
$route['view_part_operation_history/(:any)/(:any)'] = 'welcome/view_part_operation_history';

$route['customer_price'] = 'welcome/customer_price';
$route['add_customer_price'] = 'welcome/add_customer_price';
$route['add_customer_operation'] = 'welcome/add_customer_operation';
$route['add_operation_details/(:any)/(:any)/(:any)/(:any)'] = 'welcome/add_operation_details';
$route['add_customer_operation_data'] = 'welcome/add_customer_operation_data';
$route['add_job_card'] = 'welcome/add_job_card';
$route['view_job_card_details/(:any)'] = 'welcome/view_job_card_details';
$route['view_job_card_details_released/(:any)'] = 'welcome/view_job_card_details_released';
$route['view_job_card_details_issued/(:any)'] = 'welcome/view_job_card_details_issued';
$route['view_job_card_details_issued_new/(:any)/(:any)/(:any)'] = 'welcome/view_job_card_details_issued_new';
$route['view_job_card_details_closed/(:any)'] = 'welcome/view_job_card_details_closed';
$route['job_card_issued'] = 'welcome/job_card_issued';
$route['generate_job_card/(:any)'] = 'PdfControllertulsi/generate_job_card';
$route['download_stock_variance)'] = 'Excel_import/download_stock_variance';
$route['job_card'] = 'welcome/job_card';

$route['stock_rejection'] = 'welcome/stock_rejection';
$route['grn_rejection'] = 'welcome/grn_rejection';
$route['short_receipt'] = 'welcome/short_receipt_mdr';
$route['add_rejection_flow'] = 'welcome/add_rejection_flow';
$route['add_stock_down'] = 'welcome/add_stock_down';

$route['job_card_released'] = 'welcome/job_card_released';
$route['sales_invoice_released_subcon'] = 'welcome/sales_invoice_released_subcon';
$route['job_card_closed'] = 'welcome/job_card_closed';
$route['update_prod_qty'] = 'welcome/update_prod_qty';

$route['bom/(:any)'] = 'welcome/bom';
$route['customer_part_main/(:any)'] = 'welcome/customer_part_main';
$route['bom_by_id/(:any)'] = 'welcome/bom_by_id';
$route['subcon_bom/(:any)'] = 'welcome/subcon_bom';
$route['raw_material_inspection/(:any)'] = 'welcome/raw_material_inspection';
$route['raw_material_inspection_inwarding/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'welcome/raw_material_inspection_inwarding';
$route['operations_bom/(:any)'] = 'welcome/operations_bom';
$route['sharing_bom'] = 'welcome/sharing_bom';

$route['operations_bom_inputs/(:any)/(:any)/(:any)'] = 'welcome/operations_bom_inputs';
$route['drawing_history/(:any)'] = 'welcome/drawing_history';
$route['price_revision/(:any)/(:any)'] = 'welcome/price_revision';

$route['customer_part_type'] = 'welcome/customer_part_type';
$route['final_inspection'] = 'welcome/final_inspection';
$route['addCustomerType'] = 'welcome/addCustomerType';
$route['add_raw_material_inspection_master'] = 'welcome/add_raw_material_inspection_master';
$route['update_raw_material_inspection_master'] = 'welcome/update_raw_material_inspection_master';
$route['updateCustomerType'] = 'welcome/updateCustomerType';

$route['addCustomer'] = 'welcome/addCustomer';
$route['updateCustomer'] = 'welcome/updateCustomer';

$route['grn_validation'] = 'welcome/grn_validation';
$route['accept_reject_validation'] = 'welcome/accept_reject_validation';

$route['contractor'] = 'welcome/contractor';
$route['updateContractor'] = 'welcome/updateContractor';
$route['addContractor'] = 'welcome/addContractor';

$route['consumable'] = 'welcome/consumable';
$route['addConsumable'] = 'welcome/addConsumable';
$route['updateConsumable'] = 'welcome/updateConsumable';

$route['hus_number'] = 'welcome/hus_number';
$route['oc_number'] = 'welcome/oc_number';
$route['wbs_number'] = 'welcome/wbs_number';
$route['addOtherData'] = 'welcome/addOtherData';
$route['updateOtherData'] = 'welcome/updateOtherData';

$route['supplier'] = 'welcome/supplier';
$route['add_supplier'] = 'welcome/addSupplierDetails';
$route['updateSupplier'] = 'welcome/updateSupplier';
$route['addSupplier'] = 'welcome/addSupplier';

$route['approved_supplier'] = 'welcome/approved_supplier';

$route['po_details'] = 'welcome/po_details';
$route['po/(:any)'] = 'welcome/po';
$route['addPO'] = 'welcome/addPO';
$route['updatePO'] = 'welcome/updatePO';

$route['po_detailed_details'] = 'welcome/po_detailed_details';
$route['addSO'] = 'welcome/addSO';
$route['updateSO'] = 'welcome/updateSO';
$route['updateBankDetails'] = 'welcome/updateBankDetails';

$route['store'] = 'welcome/store';
$route['addStore'] = 'welcome/addStore';
$route['updateStore'] = 'welcome/updateStore';

$route['issue'] = 'welcome/issue';
$route['addissue'] = 'welcome/addissue';
$route['updateissue'] = 'welcome/updateissue';

$route['store_stock'] = 'welcome/store_stock';
$route['addissue'] = 'welcome/addissue';
$route['updateissue'] = 'welcome/updateissue';

$route['get_id'] = 'welcome/get_id';
$route['get_id_supplier'] = 'welcome/get_id_supplier';

$route['dispatch_tracking'] = 'welcome/dispatch_tracking';
$route['adddispatch_tracking'] = 'welcome/adddispatch_tracking';
$route['updatedispatch_tracking'] = 'welcome/updatedispatch_tracking';

$route['billing_track'] = 'welcome/billing_track';
$route['billing'] = 'welcome/billing';
$route['addbilling_track'] = 'welcome/addbilling_track';
$route['updatebilling_track'] = 'welcome/updatebilling_track';
$route['updateBankDetails2'] = 'welcome/updateBankDetails2';

$route['addTransport'] = 'welcome/addTransport';
$route['updateTransport'] = 'welcome/updateTransport';

$route['updateCompletedDate'] = 'welcome/updateCompletedDate';

$route['loading_user'] = 'welcome/loading_user';
$route['erp_users'] = 'welcome/erp_users';
$route['view_challan'] = 'welcome/view_challan';
$route['asset'] = 'welcome/asset';
$route['final_inspection_qa'] = 'welcome/final_inspection_qa';
// $route['shift'] = 'welcome/shiftshifts';
$route['part_family'] = 'welcome/part_family';
$route['process'] = 'welcome/process';
$route['customer_parts_master'] = 'welcome/customer_parts_master';
$route['update_customer_parts_master'] = 'welcome/update_customer_parts_master';
$route['add_users_data'] = 'welcome/add_users_data';
$route['update_users_data'] = 'welcome/update_users_data';
$route['update_p_q'] = 'welcome/update_p_q';
$route['update_accept_parts_rejection_sales_invoice'] = 'welcome/update_parts_rejection_sales_invoice';
$route['update_p_q_qty'] = 'welcome/update_p_q_qty';
$route['add_process_name'] = 'welcome/add_process_name';
$route['add_customer_parts_master'] = 'welcome/add_customer_parts_master';
$route['add_downtime_name'] = 'welcome/add_downtime_name';
$route['add_part_family'] = 'welcome/add_part_family';
$route['add_asset'] = 'welcome/add_asset';
$route['add_shifts'] = 'welcome/add_shifts';
$route['addLoadingUser'] = 'welcome/addLoadingUser';
$route['_loading_user'] = 'welcome/updateloading_user';
$route['loading/(:any)'] = 'welcome/loading';
$route['loading_detail'] = 'welcome/loading_detail';

$route['insert'] = 'welcome/insert';
$route['tool_with_insert'] = 'welcome/tool_with_insert';

$route['singlerequesrreasons'] = 'welcome/singlerequesrreasons';
$route['addSingleRequest'] = 'welcome/addSingleRequest';
$route['updateSingleRequest'] = 'welcome/updateSingleRequest';

$route['source_list'] = 'welcome/source_list';
$route['supplier_list'] = 'welcome/supplier_list';
$route['updateSource_Supplier'] = 'welcome/updateSource_Supplier';
$route['addSource_Supplier'] = 'welcome/addSource_Supplier';



//operations
$route['operations'] = 'Welcome/operations';
$route['remarks'] = 'Welcome/remarks';
$route['operations_data'] = 'Welcome/operations_data';
$route['add_operations'] = 'Welcome/add_operations';
$route['add_rejection_remark'] = 'Welcome/add_rejection_remark';
$route['add_operations_data'] = 'Welcome/add_operations_data';
$route['update_operations'] = 'Welcome/update_operations';
$route['update_job_card'] = 'Welcome/update_job_card';
$route['update_job_card_prod'] = 'Welcome/update_job_card_prod';
$route['update_job_card_operation'] = 'Welcome/update_job_card_operation';
$route['update_job_card_status'] = 'Welcome/update_job_card_status';
$route['update_job_card_details'] = 'Welcome/update_job_card_details';
$route['update_job_card_details_closed'] = 'Welcome/update_job_card_details_closed';
$route['update_job_card_status_lock'] = 'Welcome/update_job_card_status_lock';
$route['update_job_card_status_close'] = 'Welcome/update_job_card_status_close';
$route['delete'] = 'Welcome/delete';

$route['404_override'] = 'welcome/page_not_found';
$route['translate_uri_dashes'] = false;

#-------------- Customer part ----------------------------
#$route['customer_part'] = 'CustomerPartController/customer_part';
$route['customer_part/(:any)'] = 'CustomerPartController/customer_part_by_id';
$route['addcustomerpart'] = 'CustomerPartController/addcustomerpart';
$route['updatecustomerpart_new'] = 'CustomerPartController/updatecustomerpart_new';

//part operations
$route['part_operations/(:any)/(:any)'] = 'Welcome/part_operations';
$route['add_part_operations'] = 'Welcome/add_part_operations';
$route['view_history_operation_parts/(:any)/(:any)'] = 'Welcome/view_history_operation_parts';
$route['view_job_card_prod_qty_by_id/(:any)'] = 'Welcome/view_job_card_prod_qty_by_id';

//part operations
$route['part_operations_assembly'] = 'Welcome/part_operations_assembly';
$route['add_child_part'] = 'Welcome/add_child_part';
$route['add_part_operations_assembly'] = 'Welcome/add_part_operations_assembly';
$route['view_history_operation_parts_assembly/(:any)/(:any)'] = 'Welcome/view_history_operation_parts_assembly';

$route['get_po_sales_parts'] = 'Newcontroller/get_po_sales_parts';

#-------------- INHOUSE PARTS -------------------
$route['inhouse_parts_view'] = 'InhousePartsController/inhouse_parts_view';
$route['update_uom_report'] = 'InhousePartsController/update_uom_report';
$route['add_inhouse_parts'] = 'InhousePartsController/add_inhouse_parts';
$route['update_child_part_view_inhouse'] = 'InhousePartsController/update_child_part_view_inhouse';
$route['inhouse_parts_admin'] = 'InhousePartsController/inhouse_parts_admin';
$route['update_inhsoue_stock'] = 'InhousePartsController/update_inhsoue_stock';
$route['part_stocks_inhouse'] = 'InhousePartsController/part_stocks_inhouse';
$route['view_part_stocks_inhouse'] = 'InhousePartsController/view_part_stocks_inhouse';


#-------------- Supplier PARTS -------------------
$route['addchildpart'] = 'SupplierPartsController/addchildpart';
$route['child_part_view'] = 'SupplierPartsController/child_part_view';
$route['view_child_part_view_by_filter'] = 'SupplierPartsController/view_child_part_view_by_filter';
$route['update_child_part_view'] = 'SupplierPartsController/update_child_part_view';
$route['child_parts'] = 'SupplierPartsController/child_parts';
$route['update_child_stock'] = 'SupplierPartsController/update_child_stock';
$route['stock_down'] = 'SupplierPartsController/stock_down';
$route['stock_up'] = 'SupplierPartsController/stock_up';
$route['add_stock/(:any)'] = 'SupplierPartsController/add_stock';
$route['stock_up_product_list'] = 'SupplierPartsController/stock_up_product_list';
$route['delete_stock_up'] = 'SupplierPartsController/delete_stock_up';



#-------------- FG STOCK -------------------
$route['fw_stock'] = 'FGStockController/fg_stock';
$route['transfer_fg_stock_to_inhouse_stock'] = 'FGStockController/transfer_fg_stock_to_inhouse_stock';
$route['customer_parts_admin'] = 'FGStockController/customer_parts_admin';
$route['update_customer_parts_master_fg_stock'] = 'FGStockController/update_customer_parts_master_fg_stock';
$route['transfer_fg_stock_to_fg_stock'] = 'FGStockController/transfer_fg_stock_to_fg_stock';





#----------- Masters  ----------------------------------
$route['transporter'] = 'Welcome/transporter';
$route['add_transporter'] = 'Welcome/add_transporter';
$route['update_transporter'] = 'Welcome/update_transporter';

# ------------- PROD MASTER ----------------
$route['shifts'] = 'ProdMasterController/shifts';
$route['addShift'] = 'ProdMasterController/addShift';
$route['operator'] = 'ProdMasterController/operator';
$route['add_operator'] = 'ProdMasterController/add_operator';
$route['machine'] = 'ProdMasterController/machine';
$route['add_machine'] = 'ProdMasterController/add_machine';





#------------ Sales Invoice ----------------------------
$route['sales_invoice_released'] = 'SalesController/sales_invoice_released';
$route['sales_invoice_released/(:any)'] = 'SalesController/sales_invoice_released';
$route['new_sales'] = 'SalesController/new_sales';
$route['generate_new_sales'] = 'SalesController/generate_new_sales';
$route['generate_new_sales_update'] = 'SalesController/generate_new_sales_update';
$route['view_new_sales_by_id/(:any)'] = 'SalesController/view_new_sales_by_id';
$route['get_customer_parts_for_sale'] = 'SalesController/get_customer_parts_for_sale';
$route['add_sales_parts'] = 'SalesController/add_sales_parts';
$route['lock_invoice'] = 'SalesController/lock_invoice';
$route['invoice_unlock'] = 'SalesController/invoice_unlock';
$route['reuse_invoice'] = 'SalesController/reuse_invoice';
$route['cancel_sale_invoice'] = 'SalesController/cancel_sale_invoice';
$route['delete_sale_invoice'] = 'SalesController/delete_sale_invoice';
$route['sales_report'] = 'SalesController/sales_report';
$route['sales_report_export'] = 'SalesController/generateSalesReportPdf';
$route['hsn_report'] = 'SalesController/hsn_report';
$route['receivable_report'] = 'SalesController/receivable_report';
$route['outstanding_report'] = 'SalesController/outstanding_report';
$route['generate_outsanding_pdf'] = 'SalesController/generateOutsandingPdf';
$route['update_receivable_report'] = 'SalesController/update_receivable_report';
$route['view_original_sales_invoice/(:any)'] = 'PdfControllertulsi/view_original_sales_invoice';
$route['print_packing_sticker'] = 'SalesController/print_packing_sticker';
$route['getFactorsForSticker'] = 'SalesController/getFactorsForSticker';
$route['getSalesPartPackaging_details'] = 'SalesController/getSalesPartPackaging_details';

#------------ Challan ----------------------------
$route['view_challan_by_id/(:any)'] = 'ChallanController/view_challan_by_id';
$route['add_challan_parts'] = 'ChallanController/add_challan_parts';
$route['delete_challan_part'] = 'ChallanController/delete_challan_part';
$route['view_add_challan'] = 'ChallanController/view_add_challan';
$route['view_challan_pdf/(:any)/(:any)'] = 'PdfControllertulsi/view_challan_pdf';
$route['view_challan_invoice/(:any)'] = 'PdfControllertulsi/view_challan_invoice';
$route['challan_search'] = 'ChallanController/challan_search';
$route['generate_challan'] = 'ChallanController/generate_challan';

#---------------- GRN and Inwarding ----------------------
$route['grn_subcon_view/(:any)/(:any)/(:any)/(:any)'] = 'Welcome/grn_subcon_view';
$route['add_grn_qty'] = 'GRNController/add_grn_qty';
$route['grn_complete_challan_process'] = 'GRNController/grn_complete_challan_process';
$route['edit_grn_qty'] = 'GRNController/edit_grn_qty';
$route['inwarding_invoice/(:any)'] = 'GRNController/inwarding_invoice';
$route['add_invoice_number'] = 'GRNController/add_invoice_number';
$route['generate_grn'] = 'GRNController/generate_grn';
$route['update_status_grn_inwarding'] = 'GRNController/update_status_grn_inwarding';
$route['add_raw_material_inspection_report'] = 'GRNController/add_raw_material_inspection_report';
$route['update_raw_material_inspection_master_new'] = 'GRNController/update_raw_material_inspection_master_new';

# ------------- added by Aarbaj -----------
$route['update_inwarding_details'] = 'GRNController/update_inwarding_details';
$route['delete_invoice'] = 'GRNController/delete_invoice';

# ------------ Api Test ---------------------------------
$route['generateIRN'] = 'generateIRN';
$route['getEInvoice'] = 'getEInvoice';
$route['cancelEInvoice'] = 'cancelEInvoice';
$route['cancelEWayBill'] = 'cancelEWayBill';
$route['generateEWayBill'] = 'generateEWayBill';
$route['generateToken'] = 'generateToken';
$route['authentication'] = 'authentication';

#------------------------ CUSTOMER PO Tracking ------------------
$route['generate_customer_po_tracking'] = 'POTrackingController/generate_customer_po_tracking';
$route['view_customer_tracking_id/(:any)'] = 'POTrackingController/view_customer_tracking_id';
$route['add_parts_customer_trackings'] = 'POTrackingController/add_parts_customer_trackings';
$route['customer_po_tracking'] = 'POTrackingController/customer_po_tracking';
$route['customer_po_tracking_all'] = 'POTrackingController/customer_po_tracking_all';
$route['customer_po_tracking_all_closed'] = 'POTrackingController/customer_po_tracking_all_closed';

#------------ PLM Integration ---------------
#PLM- drawing
$route['customer_part_drawing/(:any)'] = 'PLMIntegration/customer_part_drawing';
$route['customer_part_documents/(:any)'] = 'PLMIntegration/customer_part_documents_by_id';
$route['add_customer_drawing'] = 'PLMIntegration/add_customer_drawing';
$route['view_part_drawing_history/(:any)/(:any)'] = 'PLMIntegration/view_part_drawing_history';
$route['updatecustomerpartdrwing'] = 'PLMIntegration/updatecustomerpartdrwing';
$route['update_drawing'] = 'PLMIntegration/update_drawing';
#PLM- document
$route['add_customer_document'] = 'PLMIntegration/add_customer_document';
$route['part_document/(:any)/(:any)/(:any)'] = 'PLMIntegration/part_document_by_name';
$route['update_part_document_individual'] = 'PLMIntegration/update_part_document_individual';

#-------------- Tushar ERP ------------------
#------------- Import ------------------
$route['customer_po_tracking_importExport'] = 'Tushar_Controller/customer_po_tracking_importExport';
$route['import_customer_po_tracking'] = 'Tushar_Controller/import_customer_po_tracking';
$route['po_export_customer_part'] = 'Tushar_Controller/po_export_customer_part';

########################## PLASTIC COMMODITY ONLY ###############

$route['grades'] = 'P_Molding/grades';
$route['add_grades'] = 'P_Molding/add_grades';
$route['add_stock_up'] = 'P_Molding/add_stock_up';
$route['remove_stock/(:any)'] = 'P_Molding/remove_stock';
$route['accept_material_request_qty'] = 'P_Molding/accept_material_request_qty';
$route['delete_material_request'] = 'P_Molding/delete_material_request';
$route['get_store_stock_material_request'] = 'P_Molding/get_store_stock_material_request';

$route['get_filtered_clientUnit'] = 'P_Molding/get_filtered_clientUnit';

#--------------------- P_Molding ----------------------------
$route['p_q_molding_production'] = 'P_Molding/p_q_molding_production';
$route['view_p_q_molding_production'] = 'P_Molding/view_p_q_molding_production';
$route['add_production_qty_molding_production'] = 'P_Molding/add_production_qty_molding_production';
$route['update_p_q_onhold_molding'] = 'P_Molding/update_p_q_onhold_molding';
$route['update_p_q_molding_production'] = 'P_Molding/update_p_q_molding_production';
$route['view_rejection_details/(:any)/(:any)/(:any)'] = 'P_Molding/view_rejection_details';
$route['add_rejection_details'] = 'P_Molding/add_rejection_details';
$route['update_rejection_details'] = 'P_Molding/update_rejection_details';
$route['view_downtime_details/(:any)/(:any)/(:any)'] = 'P_Molding/view_downtime_details';
$route['add_downtime_details'] = 'P_Molding/add_downtime_details';
$route['update_downtime_details'] = 'P_Molding/update_downtime_details';

$route['add_mold_maintenance'] = 'P_Molding/add_mold_maintenance';
$route['add_machine_mold'] = 'P_Molding/add_machine_mold';
$route['add_machine_request'] = 'P_Molding/add_machine_request';
$route['add_machine_request_details'] = 'P_Molding/add_machine_request_details';
$route['add_molding_stock_transfer'] = 'P_Molding/add_molding_stock_transfer';
$route['add_molding_final_inspection_location'] = 'P_Molding/add_molding_final_inspection_location';
$route['mold_maintenance'] = 'P_Molding/mold_maintenance';

$route['mold_maintenance_report'] = 'P_Molding/mold_maintenance_report';
$route['mold_maintenance_history/(:any)/(:any)'] = 'P_Molding/mold_maintenance_history';
$route['view_mold_by_filter_report'] = 'P_Molding/view_mold_by_filter_report';
$route['upload_mold_maintenance_doc'] = 'P_Molding/upload_mold_maintenance_doc';

$route['machine_mold'] = 'P_Molding/machine_mold';
$route['machine_request'] = 'P_Molding/machine_request';
$route['machine_request_client_unit'] = 'P_Molding/machine_request_client_unit';
$route['machine_request_completed'] = 'P_Molding/machine_request_completed';
$route['machine_request_details/(:any)'] = 'P_Molding/machine_request_details';
$route['issue_material_request_qty'] = 'P_Molding/issue_material_request_qty';
$route['molding_stock_transfer_click/(:any)'] = 'P_Molding/molding_stock_transfer_click';
$route['molding_stock_transfer'] = 'P_Molding/molding_stock_transfer';
$route['view_mold_by_filter'] = 'P_Molding/view_mold_by_filter';
$route['update_mold_maintenance'] = 'P_Molding/update_mold_maintenance';

#--------------------------- REPORTS ----------------------------------------------
$route['supplier_parts_stock_report'] = 'ReportsController/parts_stock_report';
$route['parts_stock_report'] = 'ReportsController/parts_stock_report';
$route['reports_grn'] = 'ReportsController/reports_grn';

#------------------- P_Deflashing -------------------------
$route['p_q_deflashing'] = 'P_Deflashing/p_q_deflashing';
$route['add_production_qty_deflashing'] = 'P_Deflashing/add_production_qty_deflashing';
$route['update_p_q_deflashing'] = 'P_Deflashing/update_p_q_deflashing';
$route['add_deflashing_operation'] = 'P_Deflashing/add_deflashing_operation';
$route['add_molding_deflashing_assembly_location'] = 'P_Deflashing/add_molding_deflashing_assembly_location';
$route['deflashing_operation'] = 'P_Deflashing/deflashing_operation';
$route['deflashing_stock_transfer_click/(:any)'] = 'P_Deflashing/deflashing_stock_transfer_click';
$route['deflashing_rqeust'] = 'P_Deflashing/deflashing_rqeust';
$route['addbom_deflashing'] = 'P_Deflashing/addbom_deflashing';
$route['deflashing_bom/(:any)'] = 'P_Deflashing/deflashing_bom';
########################## PLASTIC COMMODITY ENDs ###############

$route['xml_extension'] = 'SalesController/xml_extension';
$route['grn_export'] = 'ExportController/grn_export';
$route['grn_excel_export'] = 'ExportController/grn_excel_export';
$route['operation_bom_template_excel_export'] = 'ExportController/operation_bom_template_excel_export';
$route['import_operation_bom'] = 'ExportController/import_operation_bom';
$route['export_parts_stock/(:any)'] = 'ExportController/export_parts_stock';
$route['import_parts_stock/(:any)'] = 'ExportController/import_parts_stock';




/* =============================== Extra Report ================================== */
$route['global_formate_config'] = 'GlobalConfigController/globalFormateConfig';
$route['edit_formate_config'] = 'GlobalConfigController/edit_formate_config';
$route['add_formate_config'] = 'GlobalConfigController/add_formate_config';
$route['payable_report'] = 'ReportsController/payable_report';
$route['sales_summary_report'] = 'ReportsController/sales_summary_report';
$route['grn_summary_report'] = 'ReportsController/grn_summary_report';
/*
#========================== GSTHERO  ===========================================
$route['generate_E_invoice/(:any)/(:any)'] = 'EInvoiceController/generate_E_invoice';
$route['view_e_invoice_by_id/(:any)'] = 'EInvoiceController/view_e_invoice_by_id';
$route['view_E_invoice/(:any)'] = 'EInvoiceController/view_E_invoice';
$route['cancel_E_invoice_update'] = 'EInvoiceController/cancel_E_invoice_update';
#$route['cancel_EWay_Bill_update/(:any)'] = 'EInvoiceController/cancel_EWay_Bill_update';
$route['get_E_invoice/(:any)'] = 'EInvoiceController/get_E_invoice';
#$route['cancel_E_invoice/(:any)'] = 'EInvoiceController/cancel_E_invoice';
#$route['cancel_E_invoice'] = 'EInvoiceController/cancel_E_invoice';

$route['generate_EwayBill'] = 'EWayBillController/generate_EwayBill';
$route['view_EwayBill/(:any)'] = 'EWayBillController/view_EwayBill';
$route['update_e_way_bill'] = 'EWayBillController/update_e_way_bill';
$route['update_EWayBill_transporter'] = 'EWayBillController/update_EWayBill_transporter';
$route['cancel_eWayBill'] = 'EWayBillController/cancel_eWayBill';
#$route['generate_EWayBillPrint'] = 'EWayBillController/generate_EWayBillPrint';
#$route['update_EWayBill_vehicle'] = 'EWayBillController/update_EWayBill_vehicle';
#$route['update_EWayBill_validity'] = 'EWayBillController/update_EWayBill_validity';
#$route['init_MultiVehicle_EWayBill'] = 'EWayBillController/init_MultiVehicle_EWayBill';
#$route['add_MultiVehicleDet_EWayBill'] = 'EWayBillController/add_MultiVehicleDet_EWayBill';
#========================== GSTHERO ENDS  ===========================================
*/

#========================== Adaequare  ===========================================
$route['generate_E_invoice/(:any)/(:any)'] = 'NewEInvoiceController/generate_E_invoice';
$route['view_e_invoice_by_id/(:any)'] = 'NewEInvoiceController/view_e_invoice_by_id';
$route['view_E_invoice/(:any)'] = 'NewEInvoiceController/view_E_invoice';
$route['cancel_E_invoice_update'] = 'NewEInvoiceController/cancel_E_invoice_update';
#$route['cancel_EWay_Bill_update/(:any)'] = 'NewEInvoiceController/cancel_EWay_Bill_update';
$route['get_E_invoice/(:any)'] = 'NewEInvoiceController/get_E_invoice';
#$route['cancel_E_invoice/(:any)'] = 'NewEInvoiceController/cancel_E_invoice';
#$route['cancel_E_invoice'] = 'NewEInvoiceController/cancel_E_invoice';

$route['generate_EwayBill'] = 'NewEWayBillController/generate_EwayBill';
$route['view_EwayBill/(:any)'] = 'NewEWayBillController/view_EwayBill';
$route['update_e_way_bill'] = 'NewEWayBillController/update_e_way_bill';
$route['update_EWayBill_transporter'] = 'NewEWayBillController/update_EWayBill_transporter';
$route['cancel_eWayBill'] = 'NewEWayBillController/cancel_eWayBill';
#$route['generate_EWayBillPrint'] = 'NewEWayBillController/generate_EWayBillPrint';
#$route['update_EWayBill_vehicle'] = 'NewEWayBillController/update_EWayBill_vehicle';
#$route['update_EWayBill_validity'] = 'NewEWayBillController/update_EWayBill_validity';
#$route['init_MultiVehicle_EWayBill'] = 'NewEWayBillController/init_MultiVehicle_EWayBill';
#$route['add_MultiVehicleDet_EWayBill'] = 'NewEWayBillController/add_MultiVehicleDet_EWayBill';

#========================== Adaequare ENDS ===========================================
// $route['test_tpl'] = 'welcome/test_tpl';
$route['group_master'] = 'GlobalConfigController/groupMaster';
$route['group_menu'] = 'GlobalConfigController/groupMenu';
$route['forbidden_page'] = 'welcome/forbidden_page';

#=========================== added by Aarbaj Mulla ==================================

$route['daily_stock'] = 'ReportsController/get_daily_stock';

#=========================== customer challan inward And return =======================
$route['lock_challan_return'] = 'ChallanController/lock_challan_return';
$route['update_parts_customer_challan_return'] = 'ChallanController/update_parts_customer_challan_return';
$route['add_parts_customer_challan_return'] = 'ChallanController/add_parts_customer_challan_return';
$route['challan_inward'] = 'ChallanController/customerChallanRN';
$route['view_challan_return/(:any)'] = 'ChallanController/view_challan_return';
$route['generate_customer_challan_return'] = 'ChallanController/generate_customer_challan_return';
$route['update_customer_challan_return'] = 'ChallanController/update_customer_challan_return';
$route['delete_customer_challan_inward'] = 'ChallanController/delete_customer_challan_inward';
$route['challan_part_return'] = 'ChallanController/challan_part_return';
$route['generate_customer_challan_return_part'] = 'ChallanController/generate_customer_challan_return_part';
$route['challan_part_return_details/(:any)'] = 'ChallanController/challan_part_return_details';
$route['update_customer_challan_part_return'] = 'ChallanController/update_customer_challan_part_return';
$route['lock_customer_challan_return_part'] = 'ChallanController/lock_customer_challan_return_part';
$route['generate_customer_challan_part_return_pdf/(:any)/(:any)'] = 'ChallanController/generate_customer_challan_part_return_pdf';
$route['generate_customer_challan_part_return_multiple_pdf/(:any)'] = 'ChallanController/generate_customer_challan_part_return_multiple_pdf';
$route['customer_challan_report'] = 'ChallanController/customer_challan_report';
#========================== Migration Script ===========================================

// for credit note (parts_rejection_sales_invoice table)

$route['credit_note_migration_script'] = 'MagrationScript_Controller/credit_note_migration_script';
$route['store_stock'] = 'MagrationScript_Controller/store_stock';
$route['payment_days_dump_script'] = 'MagrationScript_Controller/payment_days_dump_script';

#======================== Mail Notification =======================================
$route['yesterdays_sales_for_mail'] = 'MagrationScript_Controller/yesterdays_sales_for_mail';

$route['send_email'] = 'MagrationScript_Controller/email_sender_test';


#=================================== phase 2 new route =======================
$route['scrap_report'] = 'ReportsController/scrap_report';
$route['production_scrap_report'] = 'ReportsController/production_scrap_report';
$route['production_scrap_transfer_report'] = 'ReportsController/getProductionScrapTransfer';
$route['transfer_scrap_stock'] = 'ReportsController/transfer_scrap_stock';
$route['scrap_category'] = 'welcome/scrap_category';
$route['add_update_scrap_category'] = 'welcome/add_update_scrap_category';

// export,import
$route['global_export'] = 'exportImportController/global_export';
$route['global_import'] = 'exportImportController/global_import';

// AO chnages

$route['generateAOPdf/(:any)'] = 'POTrackingController/generateAOPdf';
$route['sendAOEmail/(:any)'] = 'POTrackingController/sendAOEmail';


// export invoice
$route['country'] = 'MasterController/country';
$route['addCountry'] = 'MasterController/addCountry';
$route['updateCountry'] = 'MasterController/updateCountry';
$route['updatePort'] = 'MasterController/updatePort';
$route['addPort'] = 'MasterController/addPort';
$route['port'] = 'MasterController/port';
$route['currency'] = 'MasterController/currency';
$route['addCurrency'] = 'MasterController/addCurrency';
$route['updateCurrency'] = 'MasterController/updateCurrency';


$route['new_export_sales'] = 'ExportSalesInvoiceController/new_sales';
$route['generate_new_export_sales'] = 'ExportSalesInvoiceController/generate_new_export_sales';
$route['export_invoice_released'] = 'ExportSalesInvoiceController/sales_invoice_released';
$route['delete_export_sale_invoice'] = 'ExportSalesInvoiceController/delete_sale_invoice';
$route['cancel_export_sale_invoice'] = 'ExportSalesInvoiceController/cancel_sale_invoice';
$route['view_export_sales_by_id/(:any)'] = 'ExportSalesInvoiceController/view_export_sales_by_id';
$route['add_export_sales_parts'] = 'ExportSalesInvoiceController/add_export_sales_parts';
$route['update_export_invoice_update'] = 'ExportSalesInvoiceController/update_export_invoice_update';
$route['lock_export_invoice'] = 'ExportSalesInvoiceController/lock_invoice';
$route['export_packing_slip/(:any)'] = 'ExportSalesInvoiceController/export_packing_slip';
$route['add_export_packing_slip'] = 'ExportSalesInvoiceController/add_export_packing_slip';
$route['export_packing_slip_download/(:any)'] = 'ExportSalesInvoiceController/export_packing_slip_download';

$route['export_print_sales_invoice/(:any)'] = 'ExportSalesInvoiceController/print_sales_invoice';
$route['view_original_export_invoice/(:any)'] = 'ExportSalesInvoiceController/view_original_sales_invoice';

$route['export_invoice_packing_slip'] = 'ExportSalesInvoiceController/export_invoice_packing_slip';