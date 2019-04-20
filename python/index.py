from ddtrace import tracer

@tracer.wrap(name='business logic', service='python-business-logic')
def business_logic():
  print('hello')

business_logic()
