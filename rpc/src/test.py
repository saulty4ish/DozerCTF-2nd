from concurrent import futures
import time
import grpc
import rpc_pb2
import rpc_pb2_grpc

class ctf(rpc_pb2_grpc.ctfServicer):
    def test_api(self, request, context):
        return rpc_pb2.TestApiReply(s="hello world")
    def get_flag(self, request, context):
        return rpc_pb2.GetFlagReply(flag="flag{acc551fdeeb94cae44ab9a8565b0398c}")

def serve():
    server = grpc.server(futures.ThreadPoolExecutor(max_workers=10))
    rpc_pb2_grpc.add_ctfServicer_to_server(ctf(), server)
    server.add_insecure_port('0.0.0.0:50051')
    server.start()
    try:
        while True:
            time.sleep(60 * 60 * 24)
    except KeyboardInterrupt:
        server.stop(0)


if __name__ == '__main__':
    serve()