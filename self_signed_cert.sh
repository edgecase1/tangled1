

if [ -f rootCA.key ] ; then
    echo "CA already exists"
else
    openssl genrsa -out rootCA.key 4096 
    openssl req -new -x509 -days 365 -key rootCA.key -subj="/C=AT/ST=Austria/O=ACOSec/CN=ACOSec CA" -out rootCA.crt 
fi
                                                                                                                                                      
if [ -f test.key ] ; then
    echo "test.key already exists"
else
    openssl req -newkey rsa:2048 -nodes -keyout test.key -subj="/C=AT/ST=Austria/O=ACOSec/CN=test.example.org" -out test.csr    
    openssl x509 -req -extfile <(printf "subjectAltName=DNS:test.example.org,DNS:test.example.org") -days 365 -in test.csr -CA rootCA.crt -CAkey rootCA.key -CAcreateserial -out test.crt    
fi



