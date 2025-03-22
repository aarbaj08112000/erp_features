<?php
class Sales extends CI_Model {

	/**
	 * Calcualte tax based on tax structure and basic total(qty * rate) 
	 */
	public function getSalesPartTaxDetails($basic_total, $gst_structure) {
		$taxData['cgst_amount'] = round(($basic_total * $gst_structure->cgst) / 100,2);
		$taxData['sgst_amount'] = round(($basic_total * $gst_structure->sgst) / 100,2);
		$taxData['igst_amount'] = round(($basic_total * $gst_structure->igst) / 100,2);

		if ($gst_structure->tcs_on_tax == "no") {
			$taxData['tcs_amount'] = round((($basic_total * $gst_structure->tcs) / 100),2);
		} else {
			$taxData['tcs_amount'] = round(((($basic_total + $cgst_amount + $sgst_amount + $igst_amount) * $gst_structure->tcs) / 100),2);
		}
		$taxData['gst_amount'] = $taxData['cgst_amount'] + $taxData['sgst_amount'] + $taxData['igst_amount'];
		$taxData['total_rate'] = $basic_total + $taxData['cgst_amount'] + $taxData['sgst_amount'] + $taxData['igst_amount'];
		return $taxData;
	}

	/**
	 * Update FG stock for specific salesid, client for an action(cancelled,lock,unlock) 
	 */
	public function updateFGStockForSales($salesId, $clientId,$action) {
		$parts_data  = $this->Crud->customQuery("SELECT customer_parts_master.id as stock_master_part_id, stock.fg_stock as old_fg_stock, sales_parts.qty 
		FROM customer_parts_master_stock stock
					JOIN customer_parts_master ON stock.customer_parts_master_id = customer_parts_master.id
					JOIN customer_part ON customer_parts_master.part_number = customer_part.part_number
					JOIN sales_parts ON customer_part.id = sales_parts.part_id
					WHERE sales_parts.sales_id = ".$salesId." AND stock.clientId = ".$clientId);
		foreach ($parts_data as $p) {
				if($action === 'lock') {
					$new_fg_stock = $p->old_fg_stock - ($p->qty);
				} else {
					$new_fg_stock = $p->old_fg_stock + ($p->qty); //cancelled and unlock actions
				}

				$data_update = array(
					"fg_stock" => $new_fg_stock,
				);
				$result2 = $this->CustomerPart->updateStockById($data_update, $p->stock_master_part_id);
		}
		/*

				SELECT stock.fg_stock, sales_parts.qty FROM customer_parts_master_stock stock 
				JOIN customer_parts_master ON stock.customer_parts_master_id = customer_parts_master.id 
				JOIN customer_part ON customer_parts_master.part_number = customer_part.part_number 
				JOIN sales_parts ON customer_part.id = sales_parts.part_id WHERE sales_parts.sales_id = 3196 AND stock.clientId = 1;

			$result = $this->Crud->customQueryUpdate("UPDATE customer_parts_master_stock stock
				JOIN customer_parts_master ON stock.customer_parts_master_id = customer_parts_master.id
				JOIN customer_part ON customer_parts_master.part_number = customer_part.part_number
				JOIN sales_parts ON customer_part.id = sales_parts.part_id
				SET stock.fg_stock = stock.fg_stock - sales_parts.qty
				WHERE sales_parts.sales_id = ".$salesId."
				AND stock.clientId = ".$clientId);
		*/
	}

	/**
	 * Check if sales item discount is applicable, if yes return appropriate discount value
	 */
	public function isSalesItemDiscount($basic_total, $discountType, $discount){
		$discountValue = 0;
		if ($discountType === 'Amount') {
			$discountValue = $discount;
		}else if($discountType === 'Percentage') {
            $discountValue = number_format($basic_total * ($discount / 100),2);
		}
		return $discountValue;
	}

	public function update_sales_parts_amountsForDiscounts($sales_id) {
		$result = $this->Crud->customQueryUpdate("
				UPDATE sales_parts sp
				JOIN gst_structure gs ON gs.id = sp.tax_id
				JOIN new_sales ns ON ns.id = sp.sales_id
				SET
					sp.discounted_amount = round(((sp.part_price * qty) * ns.discount / 100),2),
					sp.cgst_amount = round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.cgst / 100),2),
					sp.sgst_amount = round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.sgst / 100),2),
					sp.igst_amount = round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.igst / 100),2),
					sp.tcs_amount = CASE
						WHEN gs.tcs_on_tax = 'no' THEN
							round(((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.tcs) / 100),2)
						ELSE
							round((((
							round(((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.cgst / 100),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.sgst / 100),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.igst / 100),2)) * gs.tcs) / 100),2)
						END,
					sp.gst_amount = 
							(round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.cgst / 100),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.sgst / 100),2) +
							round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.igst / 100),2)),
					sp.total_rate = (
									round(((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)),2) +
									round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.cgst / 100),2)+
									round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.sgst / 100),2) +
									round((((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)) * gs.igst / 100),2)
								),
					sp.basic_total = round(((sp.part_price * qty) - ((sp.part_price * qty) * ns.discount / 100)),2)
					WHERE sp.sales_id = " . $sales_id);
	} 
}

?>