const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');

function grabScreenshot(tabId, path) {
  return new Promise((resolve, reject) => {
    const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/' + tabId);
    let done = false;
    
    ws.on('open', () => {
      ws.send(JSON.stringify({id: 1, method: 'Page.enable'}));
      ws.send(JSON.stringify({id: 2, method: 'Page.captureScreenshot', params: {format: 'png'}}));
    });
    
    ws.on('message', (data) => {
      const msg = JSON.parse(data.toString());
      if (msg.id === 2 && msg.result && msg.result.data) {
        const buf = Buffer.from(msg.result.data, 'base64');
        require('fs').writeFileSync(path, buf);
        done = true;
        console.log('SAVED:' + buf.length + ' bytes to ' + path);
        ws.close();
        resolve();
      }
    });
    
    ws.on('error', (e) => {
      console.log('WS ERROR:' + e.message);
      reject(e);
    });
    
    setTimeout(() => {
      if (!done) {
        console.log('TIMEOUT for tab ' + tabId);
        ws.close();
        reject(new Error('timeout'));
      }
    }, 10000);
  });
}

const tabs = [
  '8D8F27CF51F7B191A6DBA4952FFC7943',
  'E4C60C53B7B8B19D0B53CA8A0E9C80DC',
  'CE307A228D3537E0FF64451CA9DC9E3D'
];

(async () => {
  for (const tab of tabs) {
    try {
      await grabScreenshot(tab, '/home/ernie/.openclaw/workspace/elem-editor.png');
      console.log('Success with tab ' + tab);
      break;
    } catch(e) {
      console.log('Failed tab ' + tab + ': ' + e.message);
    }
  }
})();
