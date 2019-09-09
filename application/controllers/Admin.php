<?php 
class Admin extends CI_Controller{
    function index(){
        $data['tickets'] = $this->_tickets->get_all_tickets();
        $this->load->view("admin/index", $data);
    }
    function tickets(){
        $data['tickets'] = $this->_tickets->get_all_tickets();
        $data['counter'] = $this->_tickets->count_tickets();
        $this->load->view("admin/tickets", $data);
    }
    function add_ticket(){
        $msg = null;
        if(!empty($_POST)){
            if(!empty($this->input->post("ticket_area"))){
                $ticket['ticket'] = strip_tags($this->input->post("ticket_area"));
                $ticket['description'] = strip_tags($this->input->post("description_ticket_area"));
                $ticket['user_id'] = $this->session->userid;                
                $add_ticket = $this->_tickets->add($ticket);
                if($add_ticket > 0){
                    $msg = '<span class="alert alert-success">Ticket added successfully</span>';
                }else{
                    $msg = '<span class="alert alert-danger">Oh snap!. an error occured on creating ticket</span>';
                }
            }else{
                $msg = '<span class="alert alert-warning">Please log ticket</span>';
            }
        }
        print_r($msg);
    }
    function post_comment(){
        if(!empty($_POST)){
           $comment['ticket_id'] = $this->input->post("ticket_id");
           $comment['comment'] = $this->input->post("comment");
           $comment['user_id'] = $this->session->userid;
           #add comment in table
           $this->db->insert("ticket_status_mapping", array(
            "user_id"=> $this->session->userid,
            "status"=> 'comment',
            "role"=> $this->session->role,
            "ticket_id"=> $this->input->post("ticket_id")
            ));
           $post = $this->_tickets->post_comment($comment);
        }
    }
    function change_status(){
        if(!empty($_POST)){
            #exit(print_r($_POST));
            $change['status'] = $_POST['badge'];
            $this->db->where("id", $_POST['ticket']);
            $this->db->update("tickets", $change);
            #add mapping log entry
            $this->db->insert("ticket_status_mapping", array(
                "user_id"=> $this->session->userid,
                "status"=> $_POST['badge'],
                "role"=> $this->session->role,
                "ticket_id"=> $_POST['ticket']
            ));

            print_r($this->db->affected_rows());
        }
    }
    function edit_ticket(){
        $msg = null;
        if(!empty($_POST)){
            if(!empty($this->input->post("ticket_area"))){
                #exit(print_r($_POST));
                $ticket['ticket'] = strip_tags($this->input->post("ticket_area"));
                $ticket['description'] = strip_tags($this->input->post("description_ticket_area"));
                
                $this->db->where("id", $this->input->post("ticket_id"));        
                $this->db->update("tickets", $ticket);
                $add_ticket = $this->db->affected_rows();
                //$ticket['user_id'] = $this->session->userid;                
                //$add_ticket = $this->_tickets->edit($ticket);
                if($add_ticket > 0){
                    $msg = '<span class="alert alert-success">Ticket edited successfully</span>';
                }else{
                    $msg = '<span class="alert alert-danger">Oh snap!. an error occured on editing ticket</span>';
                }
            }else{
                $msg = '<span class="alert alert-warning">Please fill in ticket</span>';
            }
        }
        print_r($msg);
    }
    function export(){
        $this->load->view("admin/reports");
    }
    function download_excel(){ 

        $this->load->library("PHPExcel");
		
		$objPHPExcel = new PHPExcel();
		
        $objPHPExcel->getProperties()->setCreator("Conrad")
                                    ->setLastModifiedBy("Conrad")
                                    ->setTitle("Property Invoice Export")
                                    ->setSubject("Property Sheet")
                                    ->setDescription("Export Property Details")
                                    ->setKeywords("Excel Sheet")
                                    ->setCategory("Conrad");

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			// Add column headers
			$objPHPExcel->getActiveSheet()
						->setCellValue('A1', 'Property')
						->setCellValue('A2', 'Owner')
						->setCellValue('A3', 'Zone')
						->setCellValue('A4', 'Description')
						->setCellValue('A5', 'Val No.');
			$objPHPExcel->getActiveSheet()->mergeCells("A7:B7");
			$objPHPExcel->getActiveSheet()->mergeCells("D7:G7");
			$objPHPExcel->getActiveSheet()->mergeCells("D14:E14");
			$objPHPExcel->getActiveSheet()->setCellValue("A7","PROPERTY DETAILS");
			$objPHPExcel->getActiveSheet()->setCellValue("D7","PROPERTY TAXES");
			//property taxes fields
			$objPHPExcel->getActiveSheet()->setCellValue("D8","Rent Amount")
										  ->setCellValue("D9","Number of Units")
									  ->setCellValue("D10","Annual Total Rent")
										  ->setCellValue("D11","Taxable")
										  ->setCellValue("D12","Tax")
										  ->setCellValue("D14","Deposits")
										  ->setCellValue("D15","Date")
										  ->setCellValue("E15","Details")
										  ->setCellValue("F15","Assessment")
										  ->setCellValue("G15","Deposit(Ugx)")
										  ->setCellValue("H15","Balance");										  
			$bold_cell_style = array('fill' =>
													array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' =>
														array('rgb' => 'FFFF99'))
									);
			$taxes_cell_style = array('fill' =>
													array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' =>
														array('rgb' => '0080FF')),
									  'borders' => array(
								            'allborders' => array(
								                'style' => PHPExcel_Style_Border::BORDER_THIN,
								                'color' => array('rgb' => 'OOOOOO')
								            ))
									);
			$objPHPExcel->getActiveSheet()->getStyle('A1:A5')->applyFromArray($bold_cell_style);
			$objPHPExcel->getActiveSheet()->getStyle('A1:A5')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('D7:H20')->applyFromArray($taxes_cell_style);
			$objPHPExcel->getActiveSheet()->getStyle('A7:B7')->applyFromArray($bold_cell_style);
			$objPHPExcel->getActiveSheet()->getStyle("A7:B7")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle("A7:B7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("D7:G7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("D14:E14")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
				
			$objPHPExcel->getActiveSheet()->getStyle('A8:A20')->applyFromArray(
					array('fill' =>array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' =>
														array('rgb' => '99FFFF'))
									));
									  			
			// Set worksheet title
			$objPHPExcel->getActiveSheet()->setTitle("Test");
			// Redirect output to a client’s web browser (Excel5)
			//header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="test.xls"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
    }
    function download_pdf(){
        
    }
    function logout(){
        $this->session->sess_destroy();
        redirect("login/index");
    }
}