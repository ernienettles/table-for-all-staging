const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/8D8F27CF51F7B191A6DBA4952FFC7943');
ws.on('open', () => {
  console.log('connected');
  ws.send(JSON.stringify({id: 1, method: 'Page.navigate', params: {url: 'https://ernien.sg-host.com'}}));
});
ws.on('message', (data) => {
  const msg = JSON.parse(data.toString());
  console.log('msg id:', msg.id, msg.method || '');
  if (msg.id === 1) {
    setTimeout(() => {
      ws.send(JSON.stringify({id: 2, method: 'Page.captureScreenshot', params: {format: 'png'}}));
    }, 3000);
  }
  if (msg.id === 2 && msg.result && msg.result.data) {
    const buf = Buffer.from(msg.result.data, 'base64');
    require('fs').writeFileSync('/home/ernie/.openclaw/workspace/test-capture.png', buf);
    console.log('SAVED ' + buf.length + ' bytes');
    ws.close();
  }
});
ws.on('error', (e) => console.log('ERROR:', e.message));
setTimeout(() => { console.log('done'); ws.close(); }, 12000);
