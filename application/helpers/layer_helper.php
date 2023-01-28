<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function layer( 
    $array, 
    $html = '',
    $css = array(),
    $hiddenLayers = array(), 
    $meta = array(
        'FIRSTLAYER' => true,
        'x' => array(),
        'y' => array(),
    ) ) {

    foreach ( $array as $object ) {

        // Validate Layer
        // Aici trebuei sa verificam toate cheile din layer tipurile si toate sub valorile din array sau obiect

        // Scoatem tipul la layer 
        $layerType = layerType( $object );
        $parentLayerType = $meta['FIRSTLAYER'] ? 'FRAMEAUTOLAYOUT' : parentLayerType( $object->parent->id );

        // Desenam Layer
        if ( $layerType == 'FRAMEAUTOLAYOUT' || $layerType == 'FRAMENONELAYOUT' ) {
            $html .= frameStart( $object, $meta );
            $css[] = frameStyle( $object, $parentLayerType, $meta );
        }

        if ( $layerType == 'RECTANGLE' ) {
            $html .= rectangleStart( $object, $meta );	
            $css[] = rectangleStyle( $object, $parentLayerType, $meta );
        }

        if ( $layerType == 'GROUPIMAGE' ) {
        
            $hiddenLayers[] = $object->id;

            echo groupImageStart( $object, $meta );
        }

        if ( $layerType == 'TEXT' ) { 
            echo textStart( $object, $parentLayerType, $meta );
        }

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
        if ( isset($object->children) && !in_array($object->id, $hiddenLayers) ) 
            layer($object->children, $html, $css, $hiddenLayers, $meta);

        // Desenam Layer
        if ( $layerType == 'FRAMEAUTOLAYOUT' || $layerType == 'FRAMENONELAYOUT' ) 
            echo frameEnd($object);

        if ( $layerType == 'RECTANGLE' ) 
            echo rectangleEnd($object);

        if ( $layerType == 'GROUPIMAGE' ) 
            echo groupImageEnd($object);	

        if ( $layerType == 'TEXT' ) 
            echo textEnd($object);	
    }
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