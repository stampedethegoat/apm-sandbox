const tracer = require('dd-trace').init({
  hostname : 'localhost',
  port     : 8126,
  debug    : true
})

let main = () => {
  const span = tracer.startSpan('web.request')
  span.setTag('http.url', '/login')
  span.finish()
  console.log(`ran main`);
}

main();


