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
		##	1. Establish connection to DB
		##	2. Store flight table in formatted html
		##	3. Return formatted html string
		
		return {'case':'Success', 'caseMsg':'Flights table loaded!', 'flightTable':'<b> THE FLIGHT TABLE LOL </b>'}

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
