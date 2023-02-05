<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function layer( 
    $array, 
    $meta = array(
        'FIRSTLAYER' => true,
        'PARENTLAYER' => '',
        'HIDDENLAYERS' => array(),
        'x' => array(),
        'y' => array(),
    ) ) {

    foreach ( $array as $object ) {

        // Validate Layer
        // Aici trebuei sa verificam toate cheile din layer tipurile si toate sub valorile din array sau obiect

        $htmlStart = '';
        $htmlEnd = '';
        $css = '';

        // Globals Import ( Font Family, Font Style, Color )
        $globalToLayerFontFamily = globalToLayerFontFamily($object);
        $globalToLayerFontSize = globalToLayerFontSize($object);
        $fontFamilyStyleImport = fontFamilyStyleImport($object);
        $globalToLayerColor = globalToLayerColor($object);

        // Scoatem tipul la layer 
        $layerType = layerType( $object );
        $meta['PARENTLAYER'] = $meta['FIRSTLAYER'] ? 'FRAMEAUTOLAYOUT' : parentLayerType( $object->parent->id );
        $slug = slug($object->name);

        // Desenam Layer
        if ( $layerType == 'FRAMEAUTOLAYOUT' || $layerType == 'FRAMENONELAYOUT' ) {
            $htmlStart = frameStart($object, $meta);
            $htmlEnd = frameEnd($object);
            $css = cssInline($slug, frameStyle($object, $meta));
        }

        if ( $layerType == 'RECTANGLE' ) {
            $htmlStart = rectangleStart($object, $meta);	
            $htmlEnd = rectangleEnd($object);
            $css = cssInline($slug, rectangleStyle($object, $meta));
        }

        if ( $layerType == 'GROUPIMAGE' ) {
        
            $meta['HIDDENLAYERS'][] = $object->id;

            $htmlStart = groupImageStart($object, $meta);
            $htmlEnd = groupImageEnd($object);	
            $css = cssInline($slug, groupImageStyle($object, $meta));
        }

        if ( $layerType == 'TEXT' ) { 
            $htmlStart = textStart($object, $meta);
            $htmlEnd = textEnd($object);	
            $css = cssInline($slug, textStyle($object, $meta));
        }

        // Recursie 
        if ( !$meta['FIRSTLAYER'] ) {
            $meta['x'][$object->id] =  $object->x;
            $meta['y'][$object->id] =  $object->y;
        }
        else {
            $meta['x'][$object->id] = 0;
            $meta['y'][$object->id] = 0;
        }

        if ( $layerType == 'FRAMEAUTOLAYOUT' || $layerType == 'FRAMENONELAYOUT' ) {
            if ( $meta['FIRSTLAYER'] ) 
                $meta['FIRSTLAYER'] = false;
        }

        // Recursie
        $child = new stdClass();
        if ( isset($object->children) && !in_array($object->id, $meta['HIDDENLAYERS']) ) 
            $child = layer($object->children, $meta);

        // Output 
        $output = array(
            'htmlStart' => $htmlStart, 
            'htmlEnd' => $htmlEnd, 
            'css' => $css,
            'fontFamilyStyle' => $fontFamilyStyleImport,
            'fontFamily' => $globalToLayerFontFamily,
            'fontSize' => $globalToLayerFontSize,
            'color' => $globalToLayerColor,
        );

        if ( count( (array)$child ) > 0 ) 
            $arr[] = (object)($output + array('child' => $child));

        else    
            $arr[] = (object)$output;
    }

    return $arr;
}

function layerType( $object ) {

    if ( $object->type == 'GROUP' ) 
        return groupType($object);
        
    elseif ( $object->type == 'FRAME' ) 
        return frameType($object);

    elseif ( $object->type == 'RECTANGLE' ) 
        return rectangleType($object);

    elseif ( $object->type == 'COMPONENT' ) 
        return componentType($object);

    elseif ( $object->type == 'VECTOR' ) 
        return vectorType($object);

    elseif ( $object->type == 'TEXT' ) 
        return textType($object);

    else 
        console($object->type, 'eqeee');
}

function parentLayerType( $parentID ) {

    $array = figmaFile2Array( figmaFile() );

    $parentObject = parentLayerRecursie( $array[0], $parentID );

    return layerType( $parentObject );
}

function parentLayerRecursie( $node, $parentID ) {

    if ($node->id == $parentID) 
        return $node;
    
    elseif ( isset($node->children) ) {
        foreach ($node->children as $object) {
            $result = parentLayerRecursie($object, $parentID);
            if ($result != null) {
                return $result;
            }
        }
    }
    return null;
}

function layerLimit($key) { 
    $array = [
        'id',
        'parent',
        'type',
        'name',
        'visible',
        'locked',
        'opacity',
        'blendMode',
        'isMask',
        'effectStyleId',
        'x',
        'y',
        'width',
        'height',
        'rotation',
        'layoutAlign',
        'constrainProportions',
        'layoutGrow',	
        'layoutPositioning',
        'fillStyleId',	
        'strokeStyleId',	
        'strokeWeight',
        'strokeAlign',
        'strokeJoin',
        'strokeCap',	
        'strokeMiterLimit',
        'cornerRadius',
        'cornerSmoothing',
        'topLeftRadius',
        'topRightRadius',
        'bottomLeftRadius',
        'bottomRightRadius',
        'paddingLeft',
        'paddingRight',
        'paddingTop',
        'paddingBottom',
        'primaryAxisAlignItems',	
        'counterAxisAlignItems',
        'primaryAxisSizingMode',
        'strokeTopWeight',
        'strokeBottomWeight',
        'strokeLeftWeight',
        'strokeRightWeight',
        'gridStyleId',
        'backgroundStyleId',
        'clipsContent',
        'expanded',
        'layoutMode',
        'counterAxisSizingMode',
        'verticalPadding',
        'itemSpacing',
        'overflowDirection',
        'numberOfFixedChildren',
        'numberOfFixedChildren',
        'overlayPositionType',
        'overlayBackgroundInteraction',
        'itemReverseZIndex',
        'strokesIncludedInLayout',
        'listSpacing',
        'characters',
        'hasMissingFont',
        'fontSize',
        'paragraphIndent',
        'paragraphSpacing',
        'textCase',
        'textDecoration',
        'letterSpacing',
        'fontName',
        'fontWeight',
        'canUpgradeToNativeBidiSupport',
        'autoRename',
        'textAlignHorizontal',
        'textAlignVertical',
        'textAutoResize',
        'textStyleId',
        'description',
        'remote',
        'key',
        'variantPxroperties',
        'handleMirroring',
        'backgrounds',
        'stuckNodes',
        'attachedConnectors',
        'componentPropertyReferences',
        'effects',
        'absoluteRenderBounds',
        'absoluteBoundingBox',
        'dashPattern',
        'layoutGrids',
        'guides',
        'constraints',
        'overlayBackground',
        'reactions',
        'playbackSettings',
        'lineHeight',
        'hyperlink',
        'documentationLinks',
        'instances',
        'variantProperties',
        'componentPropertyDefinitions',
        'vectorNetwork',
    ];
    
    if ( !in_array($key, $array) ) 
        console($key, 'layerLimit');
}

function layerIgnore($key) { 
    $array = [
        'children',
        'relativeTransform',
        'absoluteTransform',
        'fills',
        'fillGeometry',
        'strokes',
        'strokeGeometry',
        'exportSettings',
        'vectorPaths',
    ];

    if ( !in_array($key, $array) ) 
        console($key, 'layerIgnore');
}

function backgroundLimit($key) {

    $array = [
        'type',
        'visible',
        'opacity',
        'blendMode',
        'color',
    ];

    if ( !in_array($key, $array) ) 
        console($key, 'backgroundLimit');
}