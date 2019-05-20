from flask import Flask,g,jsonify,request
import grpc
import rpc_pb2
import rpc_pb2_grpc
app = Flask(__name__)


@app.before_request
def init():
    g.api_address="120.27.3.220:10004"

@app.route('/',methods=['POST','UPDATE','PUT','GET'])
def hello_world():
    if request.method=='GET':
        return jsonify({"code":0,"msg":"restful"})
    html=""
    with open(__file__,"r") as f:
        for line in f.readlines():
            html += line.replace('&', '&amp;').replace('\t', '&nbsp;' * 4).replace(' ', '&nbsp;').replace('<','&lt;').replace('>', '&gt;').replace('\n', '<br />')
    return html

@app.route('/test')
def test_api():
    channel = grpc.insecure_channel(g.api_address)
    stub = rpc_pb2_grpc.ctfStub(channel)
    response = stub.test_api(rpc_pb2.CommonRequest())
    return jsonify({"code":0,"msg":response.s})

@app.route('/flag')
def get_flag():
    '''channel = grpc.insecure_channel(g.api_address)
    stub = rpc_pb2_grpc.ctfStub(channel)
    response = stub.get_flag(rpc_pb2.CommonRequest())
    return response.flag
    '''
    return jsonify({"code":0,"msg":"stupid man"})

if __name__ == '__main__':
    app.run(host="0.0.0.0")
