dd_trace("CustomDriver", "doWork", function (...$args) {
    // Start a new span
    $scope = GlobalTracer::get()->startActiveSpan('CustomDriver.doWork');
    $span = $scope->getSpan();

    // Access object members via $this
    $span->setTag(Tags\RESOURCE_NAME, $this->workToDo);

    try {
        // Execute the original method
        $result = $this->doWork(...$args);
        // Set a tag based on the return value
        $span->setTag('doWork.size', count($result));
        return $result;
    } catch (Exception $e) {
        // Inform the tracer that there was an exception thrown
        $span->setError($e);
        // Bubble up the exception
        throw $e
    } finally {
        // Close the span
        $span->finish();
    }
});

$rootSpan = \DDTrace\GlobalTracer::get()
    ->getRootScope()
    ->getSpan();
$rootSpan->setTag(\DDTrace\Tag::HTTP_STATUS_CODE, 200);
