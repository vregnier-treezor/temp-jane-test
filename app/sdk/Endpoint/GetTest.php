<?php

namespace App\sdk\Endpoint;

class GetTest extends \App\sdk\Runtime\Client\BaseEndpoint implements \App\sdk\Runtime\Client\Endpoint
{
    /**
     * 
     *
     * @param array $headerParameters {
     *     @var string $Accept 
     *     @var string $Accept-Encoding 
     *     @var string $Connection 
     *     @var string $Content-Length 
     *     @var string $Content-Type 
     *     @var string $Postman-Token 
     *     @var string $User-Agent 
     *     @var string $X-Username 
     *     @var string $Host 
     * }
     */
    public function __construct(array $headerParameters = array())
    {
        $this->headerParameters = $headerParameters;
    }
    use \App\sdk\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return '/test';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    protected function getHeadersOptionsResolver() : \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(array('Accept', 'Accept-Encoding', 'Connection', 'Content-Length', 'Content-Type', 'Postman-Token', 'User-Agent', 'X-Username', 'Host'));
        $optionsResolver->setRequired(array());
        $optionsResolver->setDefaults(array());
        $optionsResolver->addAllowedTypes('Accept', array('string'));
        $optionsResolver->addAllowedTypes('Accept-Encoding', array('string'));
        $optionsResolver->addAllowedTypes('Connection', array('string'));
        $optionsResolver->addAllowedTypes('Content-Length', array('string'));
        $optionsResolver->addAllowedTypes('Content-Type', array('string'));
        $optionsResolver->addAllowedTypes('Postman-Token', array('string'));
        $optionsResolver->addAllowedTypes('User-Agent', array('string'));
        $optionsResolver->addAllowedTypes('X-Username', array('string'));
        $optionsResolver->addAllowedTypes('Host', array('string'));
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     *
     * @return null|\App\sdk\Model\TestResponse
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'App\\sdk\\Model\\TestResponse', 'json');
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array();
    }
}