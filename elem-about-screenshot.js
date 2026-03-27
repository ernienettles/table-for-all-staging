const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const fs = require('fs');

const TAB = '8D8F27CF51F7B191A6DB';
const ws = new WebSocket(`ws://127.0.0.1:18800/devtools/page/${TAB}`);

let step = 0;
ws.on('open', () => {
  ws.send(JSON.stringify({id: 1, method: 'Page.navigate', params: {url: 'https://ernien.sg-host.com/about'}}));
});
ws.on('message', (data) => {
  const msg = JSON.parse(data.toString());
  if (msg.id === 1) {
    step = 1;
    setTimeout(() => ws.send(JSON.stringify({id: 2, method: 'Page.captureScreenshot', params: {format: 'png', quality: 90}})), 4000);
  }
  if (msg.id === 2 && msg.result && msg.result.data) {
    fs.writeFileSync('/home/ernie/.openclaw/workspace/about-current.png', Buffer.from(msg.result.data, 'base64'));
    console.log('SAVED about-current.png');
    ws.close();
    process.exit(0);
  }
});
ws.on('error', (e) => { console.log('ERR:' + e.message); process.exit(1); });
setTimeout(() => { console.log('timeout'); ws.close(); process.exit(1); }, 15000);
