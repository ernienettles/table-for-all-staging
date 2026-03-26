const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/CE307A228D3537E0FF64451CA9DC9E3D');
ws.on('open', () => {
  ws.send(JSON.stringify({id:1,method:'Page.enable'}));
});
ws.on('message', (data) => {
  const msg = JSON.parse(data.toString());
  if (msg.id === 1) {
    console.log('Page enabled, waiting...');
    setTimeout(() => {
      ws.send(JSON.stringify({id:2,method:'Page.captureScreenshot',params:{format:'png'}}));
    }, 4000);
  }
  if (msg.id === 2 && msg.result && msg.result.data) {
    require('fs').writeFileSync('/tmp/elem-editor3.png', Buffer.from(msg.result.data, 'base64'));
    console.log('saved');
  }
});
setTimeout(() => ws.close(), 10000);
