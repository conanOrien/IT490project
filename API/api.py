import mysql.connector
from mysql.connector import errorcode
from flask import Flask
from flask_restful import Resource, Api, fields, marshal_with

app = Flask(__name__)
api = Api(app)

##
## Function definition
##
class viewFlights(Resource):
	def get(self):
		## Framework for function
		## -Each step should have a break with a detailed error message for failure
		##
		##	1. Establish connection to/query DB
		##	2. Store flight table in formatted html
		##	3. Return formatted html string
		
		case = None
		caseMsg = None
		flightTable = None

		## 1.
		try:
			conn = mysql.connector.connect(user='dkl9',
							password='thisIsNotAJoke!!',
							host='127.0.0.1',
							database='dkl9')
		except mysql.connector.Error as err:
			if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
				case = 'Failure'
				caseMsg = 'Invalid Credentials'
				return {'case': str(case), 'caseMsg':str(caseMsg), 'flightTable':str(flightTable)}
			
			elif err.errno == errorcode.ER_BAD_DB_ERROR:
				case = 'Failure'
				caseMsg = 'DB does not exist'
				return {'case': str(case), 'caseMsg':str(caseMsg), 'flightTable':str(flightTable)}
			
			else:
				case = 'Failure'
				caseMsg = 'General Error: '+err
				return {'case': str(case), 'caseMsg':str(caseMsg), 'flightTable':str(flightTable)}

		point = conn.cursor()
		sql = "SELECT * FROM flight"
		point.execute(sql)
		
		## 2.
		flightTable = '<h2>Flights</h2>'
		flightTable += '<table class = "table table-bordered table-hover"><thead><tr><th>Flight Number</th><th>Tail Number</th><th>Crew ID</th><th>Departure From </th><th>Departure To </th><th>Departure Time </th><th>Arrivals Time </th><th>Cargo Number</th></tr></thead><tbody>'
		for row in point:
        		flightTable += '<tr><td>'+str(row[0])+'</td><td>'+str(row[1])+'</td><td>'+str(row[2])+'</td><td>'+str(row[3])+'</td><td>'+str(row[4])+'</td><td>'+str(row[5])+'</td><td>'+str(row[6])+'</td><td>'+str(row[7])+'</td></tr>'
		case = 'Success'
		caseMsg = 'Database queried successfully'
		## 3.
		conn.close()
		return {'case': str(case), 'caseMsg':str(caseMsg), 'flightTable':str(flightTable)}

class addCargo(Resource):
	def post(self):
		## Framework for function
		## -Note, each step should have a break with a detailed error message output for failure
		##
		##	1. Establish connection to DB
		##	2. Build/Send DB query; store response in var	
		##	3. If successful, return row
		##	4. If fail return error message

		return {'case':'Success', 'caseMsg':'Cargo was added to flight $flightnum!'}

class searchFlight(Resource):
	def get(self):
		## Framework for function
		## -Each step should have a break with a detailed error message for failure
		##
		##	1. Establish connection to DB
		##	2. Read in flight number supplied
		##	3. Query DB and check for results
		##	4. If results, send table back

		return {'case':'Success', 'caseMsg':'Query results loaded!', 'flightTable':'<b> THIS IS WHAT YOU SEARCHED FOR RIGHT???? </b>'}


##
## Function routing and domain definition
##
api.add_resource(viewFlights, '/view')
api.add_resource(addCargo, '/add')
api.add_resource(searchFlight, '/search')

if __name__ == '__main__':
	app.run(host='0.0.0.0')
