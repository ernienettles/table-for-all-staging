import websocket
import json
import time
import base64

ws_url = "ws://127.0.0.1:18800"

def ws_send(ws, method, params=None, id=1):
    msg = {"jsonrpc": "2.0", "method": method, "id": id}
    if params:
        msg["params"] = params
    ws.send(json.dumps(msg))

def ws_recv(ws):
    while True:
        data = ws.recv()
        msg = json.loads(data)
        if "id" in msg:
            return msg

ws = websocket.create_connection(ws_url)
ws.settimeout(10)

# Navigate to /about
ws_send(ws, "Page.navigate", {"url": "https://ernien.sg-host.com/about"})
time.sleep(5)

# Take screenshot
ws_send(ws, "Page.captureScreenshot", {"format": "png"}, id=2)
resp = ws_recv(ws)
if "result" in resp:
    img_data = base64.b64decode(resp["result"]["data"])
    with open("/home/ernie/.openclaw/workspace/screenshots/tfa-revert-about.png", "wb") as f:
        f.write(img_data)
    print("About page screenshot saved")

# Navigate to /
ws_send(ws, "Page.navigate", {"url": "https://ernien.sg-host.com/"})
time.sleep(4)

ws_send(ws, "Page.captureScreenshot", {"format": "png"}, id=3)
resp = ws_recv(ws)
if "result" in resp:
    img_data = base64.b64decode(resp["result"]["data"])
    with open("/home/ernie/.openclaw/workspace/screenshots/tfa-revert-home.png", "wb") as f:
        f.write(img_data)
    print("Home page screenshot saved")

ws.close()
