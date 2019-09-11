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
        $objPHPExcel->getActiveSheet()
                    ->setCellValue('A1', 'Tickets');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');            
        header('Content-Disposition: attachment;filename="myfile.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output'); 
    }
    function download_pdf(){
        $this->load->library("Pdf");
        //get tickets
        $tickets = $this->_tickets->get_all_tickets();
        $html = '';
        if(!empty($tickets)){
            $html .= '<table>';
            foreach($tickets as $ticket){
            $html .= '<tr>'. 
                    '<th>Ticket number:</th>'. 
                    '<th>TKCT-'.$ticket->id.'</th>'. 
                     '</tr>';
            $html .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $html .= '<tr>'. 
                        '<th>Ticket</th>'. 
                        '<th>'.$ticket->ticket.'</th>'. 
                     '</tr>'; 
            $html .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $html .= '<tr>'. 
                        '<th>Description</th>'. 
                        '<th>'.$ticket->description.'</th>'. 
                     '</tr>';
            $html .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $html .= '<tr>'. 
                        '<th>Comments</th>'. 
                        '<th>'.$ticket->comments.'</th>'. 
                    '</tr>';
            $html .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $html .= '<tr>'. 
                        '<th>Author</th>'.
                        '<th>'.$ticket->author.'</th>'. 
                    '</tr>';
            $html .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $html .= '<tr>'. 
                        '<th>Status</th>'.
                        '<th>'.$ticket->status.'</th>'. 
                    '</tr>';
            $html .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $html .= '<tr>'. 
                    '<th>Dateadded</th>'.
                    '<th>'.$ticket->dateadded.'</th>'. 
                '</tr>';
            }
            $html .= '</table>';
        }else{
            $html .= 'No tickets have been logged on the system.';
        }
        $title = "tickets_".date("Yhmis")."_report";
        // print_r($html);
        // exit();
        //$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("Conrad");
		$pdf->SetTitle($title);
		$pdf->SetSubject('Report');
		$pdf->SetKeywords('Report, PDF, Export');
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' ', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setFooterData(array(0,64,0), array(0,64,128));
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('dejavusans', '', 12, '', true);
		$pdf->AddPage();
		//$pdf->setTextSadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
		//$pdf->writeHTMLCell(0, 0, '', '', $layout, 0, 1, 0, true, '', true);
		$pdf->writeHTML($html, true, false, false, false, '');
		$pdf->Output($title.'.pdf', 'I');
    }
    function logout(){
        $this->session->sess_destroy();
        redirect("login/index");
    }
}