import http.server
import ssl


def get_ssl_context(certfile, keyfile):
    context = ssl.SSLContext(ssl.PROTOCOL_TLSv1_2)
    context.load_cert_chain(certfile, keyfile)
    context.set_ciphers("@SECLEVEL=1:ALL")
    return context


class MyHandler(http.server.SimpleHTTPRequestHandler):

    def do_GET(self):
        print("POST")
        content_length = int(self.headers["Content-Length"])
        post_data = self.rfile.read(content_length)
        print(post_data.decode("utf-8"))

    def do_GET(self):
        print("GET", self.path)
        self.send_response(200)
        self.end_headers()
        self.wfile.write(b'Hello, world!')


server_address = ("0.0.0.0", 4444)
httpd = http.server.HTTPServer(server_address, MyHandler)

context = get_ssl_context("cert.pem", "key.pem")
httpd.socket = context.wrap_socket(httpd.socket, server_side=True)
print("listening on {}:{}".format(server_address[0], server_address[1]))
httpd.serve_forever()
