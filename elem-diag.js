const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/CE307A228D3537E0FF64451CA9DC9E3D');
ws.on('open', () => {
  ws.send(JSON.stringify({id:1,method:'Page.getURL'}));
  ws.send(JSON.stringify({id:2,method:'Page.getTitle'}));
});
ws.on('message', (data) => {
  const msg = JSON.parse(data.toString());
  if (msg.id === 1) console.log('URL:', msg.result);
  if (msg.id === 2) console.log('Title:', msg.result);
});
setTimeout(() => ws.close(), 3000);
