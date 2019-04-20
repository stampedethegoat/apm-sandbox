const tracer = require('dd-trace').init({
  hostname : 'node-js-host',
  port     : 8126
})

let main = () => {
  const span = tracer.startSpan('web.request')
  span.setTag('http.url', '/login')
  span.finish()
  console.log(`ran main`);
}

main();


