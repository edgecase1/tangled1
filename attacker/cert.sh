


if [ ! -f ../ca/rootCA.key ] ; then
    echo "CA not found"
fi
                                                                                                                                                      
if [ -f key.pem ] ; then
    perror "test.key already exists"
else
    openssl req -newkey rsa:2048 -nodes -keyout key.pem -subj="/C=AT/ST=Austria/O=ACOSec/CN=attacker.example.com" -out attacker.csr
    openssl x509 -req -extfile <(printf "subjectAltName=DNS:attacker.example.com") -days 10 -in attacker.csr -CA ../ca/rootCA.crt -CAkey ../ca/rootCA.key -CAcreateserial -out cert.pem    
fi



