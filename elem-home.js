const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const fs = require('fs');

function grabScreenshot(tabId, path) {
  return new Promise((resolve, reject) => {
    const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/' + tabId);
    let done = false;
    ws.on('open', () => {
      ws.send(JSON.stringify({id: 1, method: 'Page.enable'}));
    });
    ws.on('message', (data) => {
      const msg = JSON.parse(data.toString());
      if (msg.id === 1) {
        setTimeout(() => ws.send(JSON.stringify({id: 2, method: 'Page.navigate', params: {url: 'https://ernien.sg-host.com'}})), 500);
      }
      if (msg.id === 2) {
        setTimeout(() => ws.send(JSON.stringify({id: 3, method: 'Page.captureScreenshot', params: {format: 'png'}})), 3000);
      }
      if (msg.id === 3 && msg.result && msg.result.data) {
        const buf = Buffer.from(msg.result.data, 'base64');
        fs.writeFileSync(path, buf);
        done = true;
        console.log('SAVED ' + buf.length + ' bytes');
        ws.close();
        resolve();
      }
    });
    ws.on('error', (e) => { console.log('ERR:' + e.message); reject(e); });
    setTimeout(() => { if (!done) { ws.close(); reject(new Error('timeout')); } }, 15000);
  });
}

(async () => {
  const tabs = ['8D8F27CF51F7B191A6DBA4952FFC7943', 'E4C60C53B7B8B19D0B53CA8A0E9C80DC', 'CE307A228D3537E0FF64451CA9DC9E3D'];
  for (const tab of tabs) {
    try {
      await grabScreenshot(tab, '/home/ernie/.openclaw/workspace/home-after-css.png');
      console.log('OK tab ' + tab);
      break;
    } catch(e) { console.log('fail ' + tab + ': ' + e.message); }
  }
})();
