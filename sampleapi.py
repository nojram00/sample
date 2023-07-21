import http.server
import socketserver
import json

# Define the REST API handler
class MyHandler(http.server.BaseHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/api/data':
            # Define your response data
            data = {'message': 'Hello nigga!'}
            # Set response headers
            self.send_response(205)
            self.send_header('Content-Type', 'application/json')
            self.end_headers()
            # Convert the data to JSON and send it as the response body
            self.wfile.write(json.dumps(data).encode())
        else:
            # Return 404 for other paths
            self.send_response(404)
            self.end_headers()
            self.wfile.write(b'Not Found')


if __name__ == '__main__':
    # Set the server port (e.g., 8000)
    PORT = 8000
    # Create the server
    with socketserver.TCPServer(("", PORT), MyHandler) as httpd:
        print("Server started at port", PORT)
        # Start the server and keep it running until interrupted
        httpd.serve_forever()
