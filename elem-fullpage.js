const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const fs = require('fs');
const TAB = '8D8F27CF51F7B191A6DBA4952FFC7943';
const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/' + TAB);
let done = false;
ws.on('open', () => {
  ws.send(JSON.stringify({id:1,method:'Page.navigate',params:{url:'https://ernien.sg-host.com'}}));
});
ws.on('message', (data) => {
  const msg = JSON.parse(data.toString());
  if (msg.id === 1) {
    setTimeout(() => {
      ws.send(JSON.stringify({id:2,method:'Emulation.setDeviceScaleFactor',params:{scale:1.5}}));
    }, 500);
  }
  if (msg.id === 2) {
    setTimeout(() => {
      ws.send(JSON.stringify({id:3,method:'Page.captureScreenshot',params:{format:'png',captureBeyondViewport:true}}));
    }, 3000);
  }
  if (msg.id === 3 && msg.result && msg.result.data) {
    fs.writeFileSync('/home/ernie/.openclaw/workspace/tfa-home-full.png', Buffer.from(msg.result.data,'base64'));
    done = true;
    console.log('SAVED ' + msg.result.data.length + ' chars');
    ws.close();
    process.exit(0);
  }
});
ws.on('error', (e) => { console.log('ERR:'+e.message); process.exit(1); });
setTimeout(()=>{ if(!done){console.log('timeout'); ws.close(); process.exit(1);} }, 20000);
