const WebSocket = require('/home/ernie/.nvm/versions/node/v25.8.1/lib/node_modules/openclaw/node_modules/ws');
const ws = new WebSocket('ws://127.0.0.1:18800/devtools/page/8D8F27CF51F7B191A6DBA4952FFC7943');
ws.on('open', () => {
  ws.send(JSON.stringify({id: 1, method: 'Page.enable'}));
});
ws.on('message', (data) => {
  const msg = JSON.parse(data.toString());
  if (msg.id === 1) {
    setTimeout(() => {
      ws.send(JSON.stringify({id: 2, method: 'Runtime.evaluate', params: {
        expression: `
          // Click Style tab
          var styleTab = document.querySelector('li[data-tab="style"]');
          if (styleTab) { styleTab.click(); console.log('clicked style tab'); } 
          else { console.log('style tab not found'); }
        `
      }}));
    }, 1000);
  }
  if (msg.id === 2) {
    setTimeout(() => {
      ws.send(JSON.stringify({id: 3, method: 'Runtime.evaluate', params: {
        expression: `
          // Scroll style panel and look for Text Shadow control
          var panel = document.querySelector('.elementor-panel');
          if (panel) {
            var headings = panel.querySelectorAll('h3, .elementor-panel-heading');
            headings.forEach(function(h){ if(h.textContent.includes('Style')) console.log('FOUND STYLE:', h.textContent); });
          }
          // Try clicking Typography section
          var sections = panel.querySelectorAll('.elementor-panel-section');
          sections.forEach(function(s){ if(s.textContent.includes('Typography')) { s.click(); console.log('clicked Typography'); } });
        `
      }}));
    }, 2000);
  }
  if (msg.id === 3) {
    setTimeout(() => {
      ws.send(JSON.stringify({id: 4, method: 'Page.captureScreenshot', params: {format: 'png'}}));
    }, 2000);
  }
  if (msg.result && msg.result.data) {
    const buf = Buffer.from(msg.result.data, 'base64');
    require('fs').writeFileSync('/home/ernie/.openclaw/workspace/elem-style.png', buf);
    console.log('SAVED ' + buf.length + ' bytes');
  }
});
setTimeout(() => ws.close(), 15000);
