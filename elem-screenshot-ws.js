const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/8D8F27CF51F7B191A6DBA4952FFC7943');
ws.on('open', () => {
  ws.send(JSON.stringify({id:1,method:'Page.enable'}));
});
ws.on('message', (data) => {
  const msg = JSON.parse(data.toString());
  if (msg.id === 1) {
    setTimeout(() => {
      ws.send(JSON.stringify({id:2,method:'Page.captureScreenshot',params:{format:'png'}}));
    }, 4000);
  }
  if (msg.id === 2 && msg.result && msg.result.data) {
    require('fs').writeFileSync('/home/ernie/.openclaw/workspace/elem-editor-ws.png', Buffer.from(msg.result.data, 'base64'));
    console.log('saved to workspace');
  }
});
setTimeout(() => ws.close(), 10000);
