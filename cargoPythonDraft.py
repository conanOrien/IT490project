    if_POST['type'] == "ca":
         cargonumber = trim(_POST['cargonumber'])
         weight = trim(_POST['weight'])
         content = trim(_POST['content'])
       
        sql = "INSERT INTO cargo (SkidNum, Weight, Content)""
        VALUES (cargonumber, weight, 'content')"

        if  conn->query(sql) === TRUE):
            echo json_encode("Cargo added successfully")

        elif :
            print json_encode("Error while adding !") 
        
            conn->close()
    
