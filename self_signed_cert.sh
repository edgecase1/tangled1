
perror()
{
   echo "error: $*" >&2
   exit 1
}


if [ -f ca/rootCA.key ] ; then
    echo "CA already exists"
else
    openssl genrsa -out ca/rootCA.key 4096 
    openssl req -new -x509 -days 365 -key ca/rootCA.key -subj="/C=AT/ST=Austria/O=ACOSec/CN=ACOSec CA" -out ca/rootCA.crt 
fi
                                                                                                                                                      
if [ -f keys/test.key ] ; then
    perror "test.key already exists"
else
    openssl req -newkey rsa:2048 -nodes -keyout keys/test.key -subj="/C=AT/ST=Austria/O=ACOSec/CN=test.example.org" -out csr/test.csr
    openssl x509 -req -extfile <(printf "subjectAltName=DNS:*.example.org,DNS:test.example.org") -days 365 -in csr/test.csr -CA ca/rootCA.crt -CAkey ca/rootCA.key -CAcreateserial -out cert/test.crt    
fi



