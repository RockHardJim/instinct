<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2/dlp.proto

namespace Google\Cloud\Dlp\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Compute numerical stats over an individual column, including
 * min, max, and quantiles.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2.PrivacyMetric.NumericalStatsConfig</code>
 */
class PrivacyMetric_NumericalStatsConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * Field to compute numerical stats on. Supported types are
     * integer, float, date, datetime, timestamp, time.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.FieldId field = 1;</code>
     */
    private $field = null;

    public function __construct() {
        \GPBMetadata\Google\Privacy\Dlp\V2\Dlp::initOnce();
        parent::__construct();
    }

    /**
     * Field to compute numerical stats on. Supported types are
     * integer, float, date, datetime, timestamp, time.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.FieldId field = 1;</code>
     * @return \Google\Cloud\Dlp\V2\FieldId
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Field to compute numerical stats on. Supported types are
     * integer, float, date, datetime, timestamp, time.
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.FieldId field = 1;</code>
     * @param \Google\Cloud\Dlp\V2\FieldId $var
     * @return $this
     */
    public function setField($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2\FieldId::class);
        $this->field = $var;

        return $this;
    }

}

