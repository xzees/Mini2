# Mini

Mini No FrameWork.

<a href="https://github.com/klein/klein.php">klein</a> is a fast & flexible router for PHP 5.3+

<a href="https://github.com/illuminate/database">illuminate/database</a> for PHP 5.3+

The Illuminate Database component is a full database toolkit for PHP, providing an expressive query builder, ActiveRecord style ORM, and schema builder. It currently supports MySQL, Postgres, SQL Server, and SQLite. It also serves as the database layer of the Laravel PHP framework.

#Base Controller

<div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-smi">$this->request</span><span class="pl-k">-&gt;</span></span>
<span class="pl-s1">    id(<span class="pl-smi">$hash</span> <span class="pl-k">=</span> <span class="pl-c1">true</span>)                    <span class="pl-c"><span class="pl-c">//</span> Get a unique ID for the request</span></span>
<span class="pl-s1">    paramsGet()                         <span class="pl-c"><span class="pl-c">//</span> Return the GET parameter collection</span></span>
<span class="pl-s1">    paramsPost()                        <span class="pl-c"><span class="pl-c">//</span> Return the POST parameter collection</span></span>
<span class="pl-s1">    paramsNamed()                       <span class="pl-c"><span class="pl-c">//</span> Return the named parameter collection</span></span>
<span class="pl-s1">    cookies()                           <span class="pl-c"><span class="pl-c">//</span> Return the cookies collection</span></span>
<span class="pl-s1">    server()                            <span class="pl-c"><span class="pl-c">//</span> Return the server collection</span></span>
<span class="pl-s1">    headers()                           <span class="pl-c"><span class="pl-c">//</span> Return the headers collection</span></span>
<span class="pl-s1">    files()                             <span class="pl-c"><span class="pl-c">//</span> Return the files collection</span></span>
<span class="pl-s1">    body()                              <span class="pl-c"><span class="pl-c">//</span> Get the request body</span></span>
<span class="pl-s1">    params()                            <span class="pl-c"><span class="pl-c">//</span> Return all parameters</span></span>
<span class="pl-s1">    params(<span class="pl-smi">$mask</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                <span class="pl-c"><span class="pl-c">//</span> Return all parameters that match the mask array - extract() friendly</span></span>
<span class="pl-s1">    param(<span class="pl-smi">$key</span>, <span class="pl-smi">$default</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)        <span class="pl-c"><span class="pl-c">//</span> Get a request parameter (get, post, named)</span></span>
<span class="pl-s1">    isSecure()                          <span class="pl-c"><span class="pl-c">//</span> Was the request sent via HTTPS?</span></span>
<span class="pl-s1">    ip()                                <span class="pl-c"><span class="pl-c">//</span> Get the request IP</span></span>
<span class="pl-s1">    userAgent()                         <span class="pl-c"><span class="pl-c">//</span> Get the request user agent</span></span>
<span class="pl-s1">    uri()                               <span class="pl-c"><span class="pl-c">//</span> Get the request URI</span></span>
<span class="pl-s1">    pathname()                          <span class="pl-c"><span class="pl-c">//</span> Get the request pathname</span></span>
<span class="pl-s1">    method()                            <span class="pl-c"><span class="pl-c">//</span> Get the request method</span></span>
<span class="pl-s1">    method(<span class="pl-smi">$method</span>)                     <span class="pl-c"><span class="pl-c">//</span> Check if the request method is $method, i.e. method('post') =&gt; true</span></span>
<span class="pl-s1">    query(<span class="pl-smi">$key</span>, <span class="pl-smi">$value</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)          <span class="pl-c"><span class="pl-c">//</span> Get, add to, or modify the current query string</span></span>
<span class="pl-s1">    <span class="pl-k">&lt;</span><span class="pl-c1">param</span><span class="pl-k">&gt;</span>                             <span class="pl-c"><span class="pl-c">//</span> Get / Set (if assigned a value) a request parameter</span></span>
<span class="pl-s1"></span>
<span class="pl-s1"><span class="pl-smi">$this->response</span><span class="pl-k">-&gt;</span></span>
<span class="pl-s1">    protocolVersion(<span class="pl-smi">$protocol_version</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)       <span class="pl-c"><span class="pl-c">//</span> Get the protocol version, or set it to the passed value</span></span>
<span class="pl-s1">    body(<span class="pl-smi">$body</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                              <span class="pl-c"><span class="pl-c">//</span> Get the response body's content, or set it to the passed value</span></span>
<span class="pl-s1">    status()                                        <span class="pl-c"><span class="pl-c">//</span> Get the response's status object</span></span>
<span class="pl-s1">    headers()                                       <span class="pl-c"><span class="pl-c">//</span> Return the headers collection</span></span>
<span class="pl-s1">    cookies()                                       <span class="pl-c"><span class="pl-c">//</span> Return the cookies collection</span></span>
<span class="pl-s1">    code(<span class="pl-smi">$code</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                              <span class="pl-c"><span class="pl-c">//</span> Return the HTTP response code, or set it to the passed value</span></span>
<span class="pl-s1">    prepend(<span class="pl-smi">$content</span>)                               <span class="pl-c"><span class="pl-c">//</span> Prepend a string to the response body</span></span>
<span class="pl-s1">    append(<span class="pl-smi">$content</span>)                                <span class="pl-c"><span class="pl-c">//</span> Append a string to the response body</span></span>
<span class="pl-s1">    isLocked()                                      <span class="pl-c"><span class="pl-c">//</span> Check if the response is locked</span></span>
<span class="pl-s1">    requireUnlocked()                               <span class="pl-c"><span class="pl-c">//</span> Require that a response is unlocked</span></span>
<span class="pl-s1">    lock()                                          <span class="pl-c"><span class="pl-c">//</span> Lock the response from further modification</span></span>
<span class="pl-s1">    unlock()                                        <span class="pl-c"><span class="pl-c">//</span> Unlock the response</span></span>
<span class="pl-s1">    sendHeaders(<span class="pl-smi">$override</span> <span class="pl-k">=</span> <span class="pl-c1">false</span>)                  <span class="pl-c"><span class="pl-c">//</span> Send the HTTP response headers</span></span>
<span class="pl-s1">    sendCookies(<span class="pl-smi">$override</span> <span class="pl-k">=</span> <span class="pl-c1">false</span>)                  <span class="pl-c"><span class="pl-c">//</span> Send the HTTP response cookies</span></span>
<span class="pl-s1">    sendBody()                                      <span class="pl-c"><span class="pl-c">//</span> Send the response body's content</span></span>
<span class="pl-s1">    send()                                          <span class="pl-c"><span class="pl-c">//</span> Send the response and lock it</span></span>
<span class="pl-s1">    isSent()                                        <span class="pl-c"><span class="pl-c">//</span> Check if the response has been sent</span></span>
<span class="pl-s1">    chunk(<span class="pl-smi">$str</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                              <span class="pl-c"><span class="pl-c">//</span> Enable response chunking (see the wiki)</span></span>
<span class="pl-s1">    <span class="pl-c1">header</span>(<span class="pl-smi">$key</span>, <span class="pl-smi">$value</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                     <span class="pl-c"><span class="pl-c">//</span> Set a response header</span></span>
<span class="pl-s1">    cookie(<span class="pl-smi">$key</span>, <span class="pl-smi">$value</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>, <span class="pl-smi">$expiry</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)     <span class="pl-c"><span class="pl-c">//</span> Set a cookie</span></span>
<span class="pl-s1">    cookie(<span class="pl-smi">$key</span>, <span class="pl-c1">null</span>)                              <span class="pl-c"><span class="pl-c">//</span> Remove a cookie</span></span>
<span class="pl-s1">    noCache()                                       <span class="pl-c"><span class="pl-c">//</span> Tell the browser not to cache the response</span></span>
<span class="pl-s1">    redirect(<span class="pl-smi">$url</span>, <span class="pl-smi">$code</span> <span class="pl-k">=</span> <span class="pl-c1">302</span>)                     <span class="pl-c"><span class="pl-c">//</span> Redirect to the specified URL</span></span>
<span class="pl-s1">    dump(<span class="pl-smi">$obj</span>)                                      <span class="pl-c"><span class="pl-c">//</span> Dump an object</span></span>
<span class="pl-s1">    <span class="pl-c1">file</span>(<span class="pl-smi">$path</span>, <span class="pl-smi">$filename</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                   <span class="pl-c"><span class="pl-c">//</span> Send a file</span></span>
<span class="pl-s1">    json(<span class="pl-smi">$object</span>, <span class="pl-smi">$jsonp_prefix</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)             <span class="pl-c"><span class="pl-c">//</span> Send an object as JSON or JSONP by providing padding prefix</span></span>
<span class="pl-s1"></span>
<span class="pl-s1"><span class="pl-smi">$this->service</span><span class="pl-k">-&gt;</span></span>
<span class="pl-s1">    sharedData()                                    <span class="pl-c"><span class="pl-c">//</span> Return the shared data collection</span></span>
<span class="pl-s1">    startSession()                                  <span class="pl-c"><span class="pl-c">//</span> Start a session and return its ID</span></span>
<span class="pl-s1">    flash(<span class="pl-smi">$msg</span>, <span class="pl-smi">$type</span> <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">'</span>info<span class="pl-pds">'</span></span>, <span class="pl-smi">$params</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>()   <span class="pl-c"><span class="pl-c">//</span> Set a flash message</span></span>
<span class="pl-s1">    flashes(<span class="pl-smi">$type</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                           <span class="pl-c"><span class="pl-c">//</span> Retrieve and clears all flashes of $type</span></span>
<span class="pl-s1">    markdown(<span class="pl-smi">$str</span>, <span class="pl-smi">$args</span>, <span class="pl-k">...</span>)                      <span class="pl-c"><span class="pl-c">//</span> Return a string formatted with markdown</span></span>
<span class="pl-s1">    escape(<span class="pl-smi">$str</span>)                                    <span class="pl-c"><span class="pl-c">//</span> Escape a string</span></span>
<span class="pl-s1">    refresh()                                       <span class="pl-c"><span class="pl-c">//</span> Redirect to the current URL</span></span>
<span class="pl-s1">    back()                                          <span class="pl-c"><span class="pl-c">//</span> Redirect to the referer</span></span>
<span class="pl-s1">    query(<span class="pl-smi">$key</span>, <span class="pl-smi">$value</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                      <span class="pl-c"><span class="pl-c">//</span> Modify the current query string</span></span>
<span class="pl-s1">    query(<span class="pl-smi">$arr</span>)</span>
<span class="pl-s1">    layout(<span class="pl-smi">$layout</span>)                                 <span class="pl-c"><span class="pl-c">//</span> Set the view layout</span></span>
<span class="pl-s1">    yieldView()                                     <span class="pl-c"><span class="pl-c">//</span> Call inside the layout to render the view content</span></span>
<span class="pl-s1">    render(<span class="pl-smi">$view</span>, <span class="pl-smi">$data</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>())                  <span class="pl-c"><span class="pl-c">//</span> Render a view or partial (in the scope of $response)</span></span>
<span class="pl-s1">    partial(<span class="pl-smi">$view</span>, <span class="pl-smi">$data</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>())                 <span class="pl-c"><span class="pl-c">//</span> Render a partial without a layout (in the scope of $response)</span></span>
<span class="pl-s1">    addValidator(<span class="pl-smi">$method</span>, <span class="pl-smi">$callback</span>)                <span class="pl-c"><span class="pl-c">//</span> Add a custom validator method</span></span>
<span class="pl-s1">    validate(<span class="pl-smi">$string</span>, <span class="pl-smi">$err</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                  <span class="pl-c"><span class="pl-c">//</span> Validate a string (with a custom error message)</span></span>
<span class="pl-s1">    validateParam(<span class="pl-smi">$param</span>, <span class="pl-smi">$err</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>)                  <span class="pl-c"><span class="pl-c">//</span> Validate a param</span></span>
<span class="pl-s1">    <span class="pl-k">&lt;</span><span class="pl-c1">callback</span><span class="pl-k">&gt;</span>(<span class="pl-smi">$arg1</span>, <span class="pl-k">...</span>)                          <span class="pl-c"><span class="pl-c">//</span> Call a user-defined helper</span></span>
<span class="pl-s1">    <span class="pl-k">&lt;</span><span class="pl-c1">property</span><span class="pl-k">&gt;</span>                                      <span class="pl-c"><span class="pl-c">//</span> Get a user-defined property</span></span>
<span class="pl-s1"></span>
<span class="pl-s1"><span class="pl-smi">$this->app</span><span class="pl-k">-&gt;</span></span>
<span class="pl-s1">    <span class="pl-k">&lt;</span><span class="pl-c1">callback</span><span class="pl-k">&gt;</span>(<span class="pl-smi">$arg1</span>, <span class="pl-k">...</span>)                          <span class="pl-c"><span class="pl-c">//</span>Call a user-defined helper</span></span>
<span class="pl-s1"></span>
<span class="pl-s1"><span class="pl-smi">$this->validator</span><span class="pl-k">-&gt;</span></span>
<span class="pl-s1">    notNull()                           <span class="pl-c"><span class="pl-c">//</span> The string must not be null</span></span>
<span class="pl-s1">    isLen(<span class="pl-smi">$length</span>)                      <span class="pl-c"><span class="pl-c">//</span> The string must be the exact length</span></span>
<span class="pl-s1">    isLen(<span class="pl-smi">$min</span>, <span class="pl-smi">$max</span>)                   <span class="pl-c"><span class="pl-c">//</span> The string must be between $min and $max length (inclusive)</span></span>
<span class="pl-s1">    isInt()                             <span class="pl-c"><span class="pl-c">//</span> Check for a valid integer</span></span>
<span class="pl-s1">    isFloat()                           <span class="pl-c"><span class="pl-c">//</span> Check for a valid float/decimal</span></span>
<span class="pl-s1">    isEmail()                           <span class="pl-c"><span class="pl-c">//</span> Check for a valid email</span></span>
<span class="pl-s1">    isUrl()                             <span class="pl-c"><span class="pl-c">//</span> Check for a valid URL</span></span>
<span class="pl-s1">    isIp()                              <span class="pl-c"><span class="pl-c">//</span> Check for a valid IP</span></span>
<span class="pl-s1">    isAlpha()                           <span class="pl-c"><span class="pl-c">//</span> Check for a-z (case insensitive)</span></span>
<span class="pl-s1">    isAlnum()                           <span class="pl-c"><span class="pl-c">//</span> Check for alphanumeric characters</span></span>
<span class="pl-s1">    contains(<span class="pl-smi">$needle</span>)                   <span class="pl-c"><span class="pl-c">//</span> Check if the string contains $needle</span></span>
<span class="pl-s1">    isChars(<span class="pl-smi">$chars</span>)                     <span class="pl-c"><span class="pl-c">//</span> Validate against a character list</span></span>
<span class="pl-s1">    isRegex(<span class="pl-smi">$pattern</span>, <span class="pl-smi">$modifiers</span> <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">'</span><span class="pl-pds">'</span></span>)  <span class="pl-c"><span class="pl-c">//</span> Validate against a regular expression</span></span>
<span class="pl-s1">    notRegex(<span class="pl-smi">$pattern</span>, <span class="pl-smi">$modifiers</span> <span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">'</span><span class="pl-pds">'</span></span>)</span>
<span class="pl-s1">    <span class="pl-c1">is</span><span class="pl-k">&lt;</span><span class="pl-c1">Validator</span><span class="pl-k">&gt;</span>()                     <span class="pl-c"><span class="pl-c">//</span> Validate against a custom validator</span></span>
<span class="pl-s1">    <span class="pl-c1">not</span><span class="pl-k">&lt;</span><span class="pl-c1">Validator</span><span class="pl-k">&gt;</span>()                    <span class="pl-c"><span class="pl-c">//</span> The validator can't match</span></span>
<span class="pl-s1">    <span class="pl-k">&lt;</span><span class="pl-c1">Validator</span><span class="pl-k">&gt;</span>()                       <span class="pl-c"><span class="pl-c">//</span> Alias for is&lt;Validator&gt;()</span></span></pre></div>
